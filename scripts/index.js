/* ========= GLOBALS ========= */
const GEOCODE_APIKEY = "680f928454bd6907926580ftwca9e41";
const stateSelect    = document.getElementById("stateSelect");
const zipcodeInput   = document.getElementById("zipcodeInput");
const addressInput   = document.getElementById("addressInput");
const loader         = document.getElementById("loader");

let currentForecast = [];
let currentAddress  = "";  // store the last‐used address
let forecastChart   = null; // To hold the chart instance

/* ========= input behaviour ========= */
stateSelect.addEventListener("change", () => {
  zipcodeInput.disabled = !stateSelect.value;
  if (stateSelect.value) {
    addressInput.disabled = true;
    addressInput.value    = "";
  } else {
    addressInput.disabled = false;
  }
});

addressInput.addEventListener("input", () => {
  if (addressInput.value.trim()) {
    stateSelect.disabled  = true;
    zipcodeInput.disabled = true;
    stateSelect.value     = "";
    zipcodeInput.value    = "";
  } else {
    stateSelect.disabled  = false;
    zipcodeInput.disabled = !stateSelect.value;
  }
});

function showInputs(flag) {
  document.querySelector(".calculator-card")
          .classList.toggle("hidden-section", !flag);
}

/* ========= API helpers ========= */
async function callApiChain(addr) {
  // 1) Geocode lookup
  const geo = await fetch(
    "https://geocode.maps.co/search?" +
    new URLSearchParams({ q: addr, api_key: GEOCODE_APIKEY })
  ).then(r => { if (!r.ok) throw `Geocode ${r.status}`; return r.json(); });

  if (!geo.length) throw "Address not found or Invalid Address";
  const { lat, lon } = geo[0];

  // 2) Points lookup — detect 404 (outside US)
  const pointsResponse = await fetch(`https://api.weather.gov/points/${lat},${lon}`);
  if (pointsResponse.status === 404) {
    throw "Location outside the US";
  }
  if (!pointsResponse.ok) {
    throw `Points ${pointsResponse.status}`;
  }
  const points = await pointsResponse.json();

  // 3) Forecast fetch
  const forecastResponse = await fetch(points.properties.forecast);
  if (!forecastResponse.ok) {
    throw `Forecast ${forecastResponse.status}`;
  }
  const forecastJson = await forecastResponse.json();
  return forecastJson.properties.periods;
}

function processForecast(periods) {
  const today = new Date(); today.setHours(0,0,0,0);
  const upcoming = [0,1,2].map(i => {
    const d = new Date(today);
    d.setDate(today.getDate() + i);
    return d.toLocaleDateString("en-CA");
  });

  const daily = {};
  periods.forEach(p => {
    const k = p.startTime.slice(0,10);
    if (!upcoming.includes(k)) return;
    const snow = /snow|blizzard/i.test(p.shortForecast);
    const pop  = p.probabilityOfPrecipitation?.value;
    if (!daily[k]) {
      daily[k] = {
        snow,
        temp:      p.temperature || 'N/A',
        forecast:  p.shortForecast,
        popSum:    0,
        popCnt:    0
      };
    }
    daily[k].snow ||= snow;
    if (pop != null) {
      daily[k].popSum += pop;
      daily[k].popCnt++;
    }
  });

  return upcoming.map(k => {
    if (!daily[k]) return null;
    const inF = daily[k];
    const avg = inF.popCnt ? Math.round(inF.popSum / inF.popCnt) : 0;
    return {
      isoDate: k,  // raw YYYY-MM-DD for JSON-LD
      date:     new Date(k).toLocaleDateString('en-US',{ weekday:'long', month:'short', day:'numeric' }),
      snow:     inF.snow,
      temp:     inF.temp,
      forecast: inF.forecast,
      chance:   inF.snow ? Math.max(avg,70) : Math.round(avg * 0.15)
    };
  }).filter(Boolean);
}

/* ========= calculate ========= */
async function calculateProbability() {
    let addr = addressInput.value.trim();
    if (!addr && stateSelect.value && zipcodeInput.value.trim()) {
        addr = `${zipcodeInput.value.trim()}, ${stateSelect.selectedOptions[0].text}`;
    }
    if (!addr) {
        alert("Please provide location information");
        return;
    }

    currentAddress = addr; // remember what the user entered

    loader.style.display = "flex";
    const startTime = Date.now();

    try {
        const periods = await callApiChain(addr);
        currentForecast = processForecast(periods);

        // --- SUCCESS PATH ---

        // Update the location display
        const locationElement = document.getElementById('forecastLocation');
        if (locationElement) {
            locationElement.innerHTML = `Forecast for: <strong>${currentAddress}</strong>`;
        }

        // Ensure loader shows for a minimum time on success
        const elapsedTime = Date.now() - startTime;
        const remainingTime = 7000 - elapsedTime;
        if (remainingTime > 0) {
            await new Promise(resolve => setTimeout(resolve, remainingTime));
        }

        // Destroy previous chart if it exists, then create the new one
        if (forecastChart) {
            forecastChart.destroy();
        }
        const ctx = document.getElementById('forecastChart').getContext('2d');

        // Create a new gradient for the 'Chance' area chart
        const chanceGradient = ctx.createLinearGradient(0, 0, 0, 300);
        chanceGradient.addColorStop(0, 'rgba(255, 159, 64, 0.6)'); // Warm orange
        chanceGradient.addColorStop(1, 'rgba(255, 159, 64, 0.1)');

        forecastChart = new Chart(ctx, {
            type: 'line', // Change base type to line to allow layering
            data: {
                labels: currentForecast.map(d => d.date),
                datasets: [{
                    label: 'Chance of Closure (%)',
                    data: currentForecast.map(d => d.chance),
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: chanceGradient,
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y_chance',
                    order: 2 // Draw this area chart behind the temperature line
                }, {
                    label: 'Temperature (°F)',
                    data: currentForecast.map(d => d.temp),
                    borderColor: 'rgb(54, 162, 235)', // Cool blue for temperature
                    backgroundColor: 'transparent',
                    yAxisID: 'y_temp',
                    tension: 0.4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgb(54, 162, 235)',
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    order: 1 // Ensure this line is drawn on top
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#444',
                            font: {
                                family: "'Segoe UI', system-ui, sans-serif",
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.75)',
                        titleFont: { size: 14, weight: 'bold', family: "'Segoe UI', system-ui, sans-serif" },
                        bodyFont: { size: 12, family: "'Segoe UI', system-ui, sans-serif" },
                        padding: 10,
                        cornerRadius: 4,
                        displayColors: true,
                        boxPadding: 4,
                        borderColor: 'rgba(255,255,255,0.2)',
                        borderWidth: 1,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#555', font: { weight: '500' } }
                    },
                    y_temp: {
                        type: 'linear',
                        position: 'right',
                        title: { display: true, text: 'Temperature (°F)', color: 'rgb(54, 162, 235)', font: { weight: 'bold' } },
                        grid: { drawOnChartArea: false },
                        ticks: { color: 'rgb(54, 162, 235)', font: { weight: '600' } }
                    },
                    y_chance: {
                        type: 'linear',
                        position: 'left',
                        min: 0,
                        max: 100,
                        title: { display: true, text: 'Chance of Closure (%)', color: 'rgb(255, 159, 64)', font: { weight: 'bold' } },
                        grid: {
                            color: '#e9e9e9',
                            drawBorder: false,
                            borderDash: [5, 5] // Make grid lines dashed
                        },
                        ticks: {
                            color: 'rgb(255, 159, 64)',
                            font: { weight: '600' },
                            callback: (value) => value + '%',
                            stepSize: 20
                        }
                    }
                }
            }
        });

        const wrap = document.getElementById("forecastResults");
        wrap.innerHTML = currentForecast.map(d => {
            const chanceText = d.snow ? 'Chance of Closure' : 'Precipitation Chance';
            const footerText = d.snow ? '❄️ Schools likely closed! Stay safe!' : '☀️ Normal school day expected.';
            const tempPercent = Math.max(0, Math.min(100, Number(d.temp) + 10)); // Scale temp for graph

            return `
        <div class="forecast-card ${d.snow ? 'snow-day' : 'clear-day'}">
            <div class="card-header">
                <div class="date">${d.date}</div>
                <div class="status">${d.snow ? 'Snow Day Likely' : 'Clear Day'}</div>
            </div>
            <div class="card-body">
                <p><strong>Condition:</strong> ${d.forecast}</p>

                <div class="stat-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/></svg>
                    <div class="stat-content">
                        <div class="progress-label">
                            <span>Temperature</span>
                            <span>${d.temp}°F</span>
                        </div>
                        <div class="progress-wrap temp-bar">
                            <div class="progress-fill" style="width:${tempPercent}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="stat-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M8 19v1"/><path d="M8 14v1"/><path d="M16 19v1"/><path d="M16 14v1"/><path d="M12 21v1"/><path d="M12 16v1"/></svg>
                    <div class="stat-content">
                        <div class="progress-label">
                            <span>${chanceText}</span>
                            <span>${d.chance}%</span>
                        </div>
                        <div class="progress-wrap chance-bar">
                            <div class="progress-fill" style="width:${d.chance}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">${footerText}</div>
        </div>
      `;
        }).join("");

        injectStructuredData(currentForecast, currentAddress);

        // Final UI update
        loader.style.display = "none";
        document.getElementById("results").style.display = "block";
        showInputs(false);
        document.getElementById("incomingQueries").style.display = "none";

    } catch (e) {
        // --- ERROR PATH ---
        loader.style.display = "none"; // Hide loader immediately
        console.error(e);

        if (e === "Location outside the US") {
            alert("The address you entered is outside the U.S. Please enter a valid U.S. location.");
            resetCalculator(); // Reset UI to initial state for user to try again
        } else {
            // For other errors, show an alert and display an error card
            alert(`Error: ${e}`);
            document.getElementById("forecastResults").innerHTML =
                `<div class="forecast-card">❌ Error: ${e}</div>`;
            document.getElementById("results").style.display = "block";
            showInputs(false);
            document.getElementById("incomingQueries").style.display = "none";
        }
    }
}

/* ========= reset ========= */
function resetCalculator() {
  stateSelect.value      = "";
  zipcodeInput.value     = "";
  addressInput.value     = "";
  stateSelect.disabled   = false;
  zipcodeInput.disabled  = true;
  addressInput.disabled  = false;
  document.getElementById("forecastResults").innerHTML = "";
  document.getElementById("results").style.display      = "none";

  // Destroy the chart instance if it exists
  if (forecastChart) {
    forecastChart.destroy();
    forecastChart = null;
  }

  showInputs(true);
  document.getElementById("incomingQueries").style.display = "block";
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ========= FAQ toggle ========= */
function toggleFAQ(el) {
  const ans = el.nextElementSibling;
  ans.style.display = ans.style.display === 'block' ? 'none' : 'block';
}

/* ========= PDF export ========= */
function generatePDF() {
  if (!currentForecast.length) {
    alert("Please calculate a forecast first.");
    return;
  }

  const doc   = new jspdf.jsPDF({ orientation: "p", unit: "mm", format: "a4" });
  const pageW = doc.internal.pageSize.getWidth();
  const mX    = 15, headerH = 26, gap = 14, cardH = 40;
  let   y     = headerH + gap;

  // Header strip
  doc.setFillColor(32,87,129).rect(0, 0, pageW, headerH, "F");
  doc.setFont("helvetica","bold").setFontSize(19).setTextColor(255,255,255)
     .text("Snow-Day Forecast Report", pageW/2, 16, { align: "center" });

  // User-entered address
  doc.setFont("helvetica","bold").setFontSize(14).setTextColor(27,94,32);
  doc.text(`Location: ${currentAddress}`, mX, y);
  y += 10;

  // Forecast cards
  doc.setFont("helvetica","normal").setFontSize(12).setTextColor(0,0,0);
  currentForecast.forEach((d, idx) => {
    const tint = d.snow
      ? { r:200, g:242, b:248 }
      : { r:238, g:240, b:243 };
    doc.setFillColor(tint.r, tint.g, tint.b);
    doc.roundedRect(mX, y-2, pageW - mX*2, cardH, 3, 3, "F");

    doc.setFont("helvetica","bold").text(d.date, mX+4, y+8);
    doc.setFont("helvetica","normal")
       .text(`Condition : ${d.forecast}`, mX+4, y+18)
       .text(`Temperature: ${d.temp}°F`, mX+4, y+26);

    const status = d.snow ? "School likely CLOSED" : "School expected OPEN";
    const col    = d.snow
      ? { r:183, g:28,  b:28 }
      : { r:27,  g:94,  b:32 };
    doc.setTextColor(col.r, col.g, col.b)
       .setFont("helvetica","bold")
       .text(status, pageW - mX - 4, y+18, { align: "right" })
       .setTextColor(0,0,0);

    y += cardH + 10;
    if (y + cardH > doc.internal.pageSize.getHeight() - 30 && idx < currentForecast.length - 1) {
      doc.addPage();
      y = 20;
    }
  });

  // --- New Promotional Box ---
  y += 10; // Add some space after the last card
  const promoText = "Hey Mate!! Got a business, winter café, snow shop, or own a school? You can list your business/services for free this winter for the first 15 days, and for a nominal charge thereafter.";
  const promoBoxHeight = 30;
  if (y + promoBoxHeight > doc.internal.pageSize.getHeight() - 20) {
      doc.addPage();
      y = 20;
  }

  // Draw the promo box
  doc.setFillColor(224, 247, 250); // Light cyan background
  doc.setDrawColor(32, 87, 129); // Primary color for border
  doc.setLineWidth(0.5);
  doc.roundedRect(mX, y, pageW - mX * 2, promoBoxHeight, 3, 3, "FD"); // Fill and Draw

  // Add text to the promo box
  doc.setFont("helvetica", "bold").setFontSize(12).setTextColor(32, 87, 129);
  doc.text("Feature Your Business!", pageW / 2, y + 8, { align: "center" });
  doc.setFont("helvetica", "normal").setFontSize(10).setTextColor(42, 54, 59);
  const splitText = doc.splitTextToSize(promoText, pageW - mX * 2 - 10);
  doc.text(splitText, pageW / 2, y + 15, { align: "center" });
  y += promoBoxHeight + 10; // Move y down for the next section

  // Promo + timestamp
  if (y + 14 > doc.internal.pageSize.getHeight() - 15) {
    doc.addPage();
    y = 20;
  }
  doc.setFontSize(14).setFont("helvetica","normal");
  const before = "Generated from ";
  const link   = "snowdayscalculatorai.com";
  const after  = " – visit for more forecasts!";
  let x = mX;
  doc.text(before, x, y);
  x += doc.getTextWidth(before);
  doc.setTextColor(32,87,129)
     .text(link, x, y);
  doc.link(x, y-5, doc.getTextWidth(link), 6, { url: "https://snowdayscalculatorai.com" });
  x += doc.getTextWidth(link);
  doc.setTextColor(0,0,0)
     .text(after, x, y);
  doc.text(`Generated on: ${new Date().toLocaleString()}`, mX, y+7);

  doc.save("snow-day-report.pdf");
}

/* ========= JSON-LD Structured Data ========= */
function injectStructuredData(forecasts, address) {
  // find or create the <script> for JSON-LD
  let script = document.getElementById('jsonLdForecast');
  if (!script) {
    script = document.createElement('script');
    script.type = 'application/ld+json';
    script.id   = 'jsonLdForecast';
    document.head.appendChild(script);
  }

  // build the WeatherForecast structured data
  const ld = {
    "@context": "https://schema.org",
    "@type": "WeatherForecast",
    "name": "Snow-Day Forecast",
    "weatherForecastPlace": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": address,
        "addressCountry": "US"
      }
    },
    "weatherForecastStartDateTime":
      forecasts[0].isoDate + "T00:00:00Z",
    "weatherForecastEndDateTime":
      forecasts[forecasts.length - 1].isoDate + "T23:59:59Z",
    "weatherForecastDaysType": forecasts.length,
    "dayWeatherForecast": forecasts.map(f => ({
      "@type": "WeatherForecastElement",
      "weatherForecastElementStartDateTime":
        f.isoDate + "T07:00:00Z",
      "weatherForecastElementEndDateTime":
        f.isoDate + "T19:00:00Z",
      "weatherForecastElementCondition":
        f.snow ? "Snow" : "Clear",
      "weatherForecastElementPrecipitationChance": {
        "@type": "QuantitativeValue",
        "value": f.chance,
        "unitCode": "Percent"
      },
      "weatherForecastElementTemperature": {
        "@type": "QuantitativeValue",
        "value": Number(f.temp) || 0,
        "unitCode": "DegreeFahrenheit"
      }
    }))
  };

  // serialize and inject
  script.textContent = JSON.stringify(ld, null, 2);
}
