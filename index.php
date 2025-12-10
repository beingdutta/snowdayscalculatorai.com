<?php include __DIR__ . '/includes/user_tracker.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="#1 Snow Day Calculator for Schools & Work in the US! Get your most accurate snow day forecast & closure. Skip guesswork with our reliable calculator.">
        <meta name="keywords" content="snow day, snow day calculator, snow day calculator accuweather, snow day college calculator, snow day michigan calculator, snow day chance calculator, snow day accurate calculator, snow day chance calculator, snow day predictor calculator, snow day ai calculator, snow day accurate calculator, snow day app calculator, snow day percentage calculator, snow day probability calculator, snow day calculator free, snow day predictor calculator, snow day best calculator">
        <title>SnowDay Calculator – Predict School Closures</title>
        <link rel="icon" href="/assets/site-icon-apt.png" type="image/x-icon" />
        <link rel="canonical" href="https://snowdayscalculatorai.com/" />
        <link rel="stylesheet" href="/styles/index.css" />
        <link rel="stylesheet" href="/styles/incoming-queries.css" />
        <link rel="stylesheet" href="/styles/blogs.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PXCGN0JB4F"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-PXCGN0JB4F');
        </script>

        <!-- AdSense -->
        <?php include __DIR__ . '/includes/ads.php'; ?>

        <!-- SEO: JSON-LD for Website and Organization -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "WebSite",
              "url": "https://snowdayscalculatorai.com/",
              "name": "SnowDay Calculator AI USA",
              "description": "#1 Snow Day Calculator App For the US - Predict school closures with the best accuracy.",
              "publisher": {"@type": "Organization", "name": "SnowDay Calculator AI"}
            },
            {
              "@type": "Organization",
              "url": "https://snowdayscalculatorai.com/",
              "name": "SnowDay Calculator AI"
            },
            {
              "@type": "FAQPage",
              "mainEntity": [
                {
                  "@type": "Question",
                  "name": "What Is a Snow Day ?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "A snow day is an unexpected school or work closure caused by severe winter weather. This could mean heavy snow, ice storms, dangerously low temperatures, or hazardous road conditions. Snow days are typically declared by school administrators, often in the early morning hours."
                  }
                },
                {
                  "@type": "Question",
                  "name": "How Does the Snow Day Calculator Work ?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "The snow day calculator analyzes snowfall forecasts, temperatures, wind chill, ice risk, and precipitation type from major weather APIs. It combines this with historical closure data for your specific area to provide a highly accurate prediction."
                  }
                },
                {
                  "@type": "Question",
                  "name": "How Much Snow Does It Take to Have a Snow Day at School ?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "There is no single rule. In snowy regions like Michigan, schools might stay open with 6 inches of snow, while in southern states, 1-2 inches or the threat of ice can cause closures. Our calculator personalizes this prediction for your location."
                  }
                },
                {
                  "@type": "Question",
                  "name": "How many snow days are allowed each year ?",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Most school districts build 3 to 10 emergency closure days into their academic calendars. If more days are used, they may need to be made up later in the year."
                  }
                }
              ]
            }
          ]
        }
        </script>
        <style>
            /* --- Email Modal Styles --- */
            #emailReportModal .popup-box {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                width: 90%;
                max-width: 480px;
                padding: 2rem;
                border-top: 5px solid rgb(32, 87, 129); /* Theme color */
                animation: popup-fade-in 0.3s ease-out;
                text-align: left;
            }

            @keyframes popup-fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #emailReportModal .popup-close-btn {
                top: 1rem;
                right: 1rem;
                font-size: 1.8rem;
                color: #888;
                transition: color 0.2s;
            }

            #emailReportModal .popup-close-btn:hover {
                color: #333;
            }

            #emailReportModal h3 {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-size: 1.5rem;
                color: rgb(32, 87, 129); /* Theme color */
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            #emailReportModal p {
                color: #555;
                margin-bottom: 1.5rem;
                font-size: 0.95rem;
            }

            #emailReportModal .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #444;
                font-size: 0.9rem;
            }

            #emailReportModal .form-group input,
            #emailReportModal .form-group textarea {
                width: 100%;
                padding: 0.8rem 1rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.2s, box-shadow 0.2s;
                box-sizing: border-box;
            }

            #emailReportModal .form-group input:focus,
            #emailReportModal .form-group textarea:focus {
                outline: none;
                border-color: rgb(54, 162, 235); /* Lighter blue from chart */
                box-shadow: 0 0 0 3px rgba(54, 162, 235, 0.2);
            }

            #emailReportModal .popup-buttons {
                text-align: right;
                margin-top: 1.5rem;
            }

            #emailReportModal .popup-btn.primary {
                background-color: rgb(32, 87, 129); /* Theme color */
                color: white;
                padding: 0.8rem 1.5rem;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.2s, transform 0.2s;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            #emailReportModal .popup-btn.primary:hover {
                background-color: rgb(42, 107, 159); /* Slightly lighter blue */
                transform: translateY(-2px);
            }

            #emailReportModal .popup-btn.primary:disabled {
                background-color: #999;
                cursor: not-allowed;
                transform: none;
            }

            #emailReportModal .spinner-icon {
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            /* --- New Feature Callout --- */
            .feature-callout {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.8rem 1rem;
                background-color: #eef6fc; /* A very light blue, consistent with theme */
                border-left: 4px solid rgb(54, 162, 235); /* Lighter blue from chart */
                border-radius: 8px;
                font-size: 0.9rem;
                color: #333;
                margin-top: 1rem; /* Add some space above it */
            }

            .feature-callout svg {
                flex-shrink: 0;
                color: rgb(54, 162, 235);
            }

            .feature-callout span strong {
                color: rgb(32, 87, 129); /* Main theme color for emphasis */
            }
        </style>
    </head>

    <body>
        <!---------------------------- loader ----------------------------->
        <div class="loader" id="loader">
            <div class="loader-content">
                <div class="loader-spinner"></div>
                <p id="loaderMessage">Getting things ready...</p>
            </div>
        </div>

        <?php include __DIR__ . '/navigations/header.php'; ?>

        <!-- Greeting Section -->
        <div class="greeting-bar">
            <p id="greetingMessage">Hi Stranger! Are you feeling the snow?</p>
        </div>

        <div class="container">

            <!-- incoming-queries sliding cards list -->
            <div class="incoming-queries" id="incomingQueries">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16" style="vertical-align: -0.125em;" stroke="currentColor" stroke-width="0.5"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/></svg>
                    Recent Searches in SnowDay Calculator AI USA
                </h3>
                <div class="queries-slider">
                <div class="query-list" id="queryList"></div>
                </div>
            </div>

            <!-------- calculator card ---------------->
            <div class="calculator-card">
                <!-- input area -->
                <div id="inputContainer">
                    <div class="input-note">Fill state + ZIP <em>or</em> full address</div>
                    <div class="input-section">
                        <!-- state + zip -->
                        <div>
                            <div class="input-group">
                                <select id="stateSelect">
                                    <option value="">Select State</option>
                                    <!-- 50 states + DC -->
                                    <option value="AL">Alabama</option><option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option><option value="AR">Arkansas</option>
                                    <option value="CA">California</option><option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option><option value="DE">Delaware</option>
                                    <option value="FL">Florida</option><option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option><option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option><option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option><option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option><option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option><option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option><option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option><option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option><option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option><option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option><option value="NY">New York</option>
                                    <option value="NC">North Carolina</option><option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option><option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option><option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option><option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option><option value="UT">Utah</option>
                                    <option value="VT">Vermont</option><option value="VA">Virginia</option>
                                    <option value="WA">Washington</option><option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
                                    <option value="DC">District of Columbia</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input id="zipcodeInput" type="text" placeholder="Enter ZIP Code" disabled />
                            </div>
                        </div>

                        <div class="divider"></div>

                        <!-- address -->
                        <div><div class="input-group with-icon">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.505A.5.5 0 0 0 10 15h2a.5.5 0 0 0 .5-.5V8.207l.646.647a.5.5 0 0 0 .708-.708L8 2.207 1.146 7.146a.5.5 0 0 0 .708.708L2.5 7.207V14.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5z"/></svg>
                            </span>
                            <input id="addressInput" type="text" placeholder="Enter Full Address">
                        </div></div>
                    </div>
                    <button onclick="calculateProbability()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="22"></line><line x1="17.6" y1="6.4" x2="6.4" y2="17.6"></line><line x1="22" y1="12" x2="2" y2="12"></line><line x1="17.6" y1="17.6" x2="6.4" y2="6.4"></line></svg>
                        Calculate Snow-Day Chance
                    </button>
                </div>

            </div>

            <!-- Results Section (now outside calculator card) -->
            <div id="results" class="results">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"></line><line x1="18" x2="18" y1="20" y2="4"></line><line x1="6" x2="6" y1="20" y2="16"></line></svg>
                    Snow-Day Calculator Forecasts
                </h3>
                <p id="forecastLocation" class="forecast-location"></p>
                <div class="chart-container">
                    <canvas id="forecastChart"></canvas>
                </div>
                <h2 class="results-subtitle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Day by Day Predictions Report
                </h2>
                <div id="forecastResults"></div>
                <div style="display:flex;flex-direction:column;gap:1rem">
                    <div class="feature-callout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                    <span>Did you know? You can now email this report straight to your boss, teacher, or friends!</span>
                    </div>
                    <button onclick="generatePDF()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16" stroke="currentColor" stroke-width="0.5"><path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/></svg>
                        Download PDF Report
                    </button>
                    <button onclick="openEmailModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>
                        Email Report
                    </button>
                    <button onclick="resetCalculator()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" stroke="currentColor" stroke-width="0.5"><path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/><path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg>
                        Calculate for Another Place
                    </button>
                </div>
            </div>

            <!-------------------------- Featured Articles ---------------------------->
            <div class="blog-wrapper" style="margin-top: 3rem;">
                <h2 class="blog-heading">Featured Articles</h2>
                <section class="blog-list">
                    <!-- card / tab #1 -->
                    <a class="blog-card" href="/blogs/what-is-a-snow-day">
                        <div class="blog-card-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1671188533295-ad01d3024a0c?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>What is a Snow Day?</h3>
                            <p>One of the most common winter questions from students and parents alike: “How many inches of snow does it take to cancel school?” …</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 5, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                    <!-- card / tab #2 -->
                    <a class="blog-card" href="/blogs/what-makes-a-snow-day">
                        <div class="blog-card-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1701201196877-efcde9870b42?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>What makes a Snow Day?</h3>
                            <p>Ever wonder what actually leads a school district to call off classes for snow? It's not just about how many inches fall overnight. School administrators must …</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 4, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                    <!-- card / tab #3 -->
                    <a class="blog-card" href="/blogs/how-snow-day-calculator-works">
                        <div class="blog-card-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1701201194954-3d9d69991ece?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>How Snow Day calculator works?</h3>
                            <p>A snow day chance calculator is only useful if it knows how your region responds. In places like Michigan or upstate New York, 6 inches of snow may not cancel schools …</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 3, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                    <!-- card / tab #4 -->
                    <a class="blog-card" href="/blogs/how-much-snow-for-a-snow-day">
                        <div class="blog-card-image" style="background-image: url('https://images.unsplash.com/photo-1614734292826-78010d348dfc?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>How much Snow for a Snow Day?</h3>
                            <p>The truth is, there’s no single number that applies everywhere—but with the help of modern tools like the Snow Day Calculator, you can find out what matters most for your location …</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 2, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                    <!-- card / tab #5 -->
                    <a class="blog-card" href="/blogs/how-much-snow-does-it-take-to-cancel-school">
                        <div class="blog-card-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1671004291961-6a773194fd73?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>How much Snow does it take to cancel school?</h3>
                            <p>Every winter, students across the U.S. and Canada wake up and ask the same question: “How much snow does it take to cancel school?” The answer depends on where you live, how your district operates …</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 2, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                    <!-- card / tab #6 -->
                    <a class="blog-card" href="/blogs/How-many-snow-days-do-schools-get">
                        <div class="blog-card-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1701201194704-8b7b8e21c8d2?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                        <div class="blog-card-content">
                            <h3>How many Snow Days do schools get?</h3>
                            <p> Snow days are a winter tradition—but how many do schools actually get each year? The answer depends on your location, weather patterns, and district policies. Thanks to tools like the snow day calculator…</p>
                            <div class="blog-card-footer">
                                <span>Published: Dec 1, 2025 • Read More →</span>
                            </div>
                        </div>
                    </a>
                </section>
            </div>

            <!-------------------------- FAQ ---------------------------->
            <div class="faq-section">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path></svg>
                    Frequently Asked Questions
                </h2>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">What Is a Snow Day ?<span>▼</span></div>
                    <div class="faq-answer">A snow day is an unexpected school or work closure caused by severe winter weather. This could mean heavy snow, ice storms, dangerously low temperatures, or hazardous road conditions. Snow days are typically declared by school administrators, often in the early morning hours.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">How Does the Snow Day Calculator Work ?<span>▼</span></div>
                    <div class="faq-answer">The snow day calculator analyzes snowfall forecasts, temperatures, wind chill, ice risk, and precipitation type from major weather APIs. It combines this with historical closure data for your specific area to provide a highly accurate prediction.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">How Much Snow Does It Take to Have a Snow Day at School ?<span>▼</span></div>
                    <div class="faq-answer">There is no single rule. In snowy regions like Michigan, schools might stay open with 6 inches of snow, while in southern states, 1-2 inches or the threat of ice can cause closures. Our calculator personalizes this prediction for your location.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">How many snow days are allowed each year ?<span>▼</span></div>
                    <div class="faq-answer">Most school districts build 3 to 10 emergency closure days into their academic calendars. If more days are used, they may need to be made up later in the year.</div>
                </div>
            </div>
        </div>
        <!-- /container -->

        <!-- Email Modal -->
        <div id="emailReportModal" class="popup-overlay" style="display: none;">
            <div class="popup-box">
                <button class="popup-close-btn" id="closeEmailModal" aria-label="Close">&times;</button>
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    Email Forecast Report
                </h3>
                <p>Send the generated PDF report directly to an email address.</p>
                <form id="emailReportForm">
                    <div class="form-group">
                        <label for="recipientEmail">Recipient's Email</label>
                        <input type="email" id="recipientEmail" name="email" placeholder="recipient@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="emailMessage">Optional Message</label>
                        <textarea id="emailMessage" name="message" rows="4" placeholder="e.g., Here is the forecast you asked for!"></textarea>
                    </div>
                    <p id="email-form-error" class="form-error" style="display: none;"></p>
                    <div class="popup-buttons">
                        <button type="submit" id="sendEmailBtn" class="popup-btn primary">
                            <svg class="send-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            <svg class="spinner-icon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                            <span>Send Email</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ad Popup -->
        <div class="popup-overlay" id="adPopupOverlay">
            <div class="popup-box">
                <button class="popup-close-btn" id="crossClosePopup" aria-label="Close">&times;</button>
                <h3>Hold On For a Sec Mate!!</h3>
            <p>Do you run an Airbnb, a cozy café, or a snow-related service? We’d love to support local businesses like yours. List your offering on our site’s front page and enjoy <br><span style="color: var(--primary);">15 days completely free</span>.</p>
                <p>After the trial, you can stay featured for a small, budget-friendly charge. Let’s help your business <br><br> <u>Shine this snow season together.</u></p>
                <div class="popup-buttons">
                    <a href="/contact" class="popup-btn primary">Reach out to us</a>
                    <button class="popup-btn secondary" id="closeAdPopup">OK</button>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php include __DIR__ . '/navigations/footer.php'; ?>
        <script src="/scripts/index.js"></script>
        <script src="/scripts/incoming-queries.js"></script>
        <script>
            // --- Enhanced UI Logic ---

            // 1. Location-based Greeting
            async function fetchLocationAndGreet() {
                const COOKIE_NAME = 'hasVisited';
                const greetingElement = document.getElementById('greetingMessage');
                const isReturningUser = document.cookie.split(';').some((item) => item.trim().startsWith(COOKIE_NAME + '='));

                try {
                    // Using a free IP-based geolocation service
                    const response = await fetch('https://ipapi.co/json/');
                    if (!response.ok) throw new Error('Location fetch failed');
                    
                    const data = await response.json();
                    const location = data.city || 'local'; // Fallback to 'local'

                    if (isReturningUser) {
                        greetingElement.innerHTML = `We know a ${location} winter is a special kind of chilly, isn't it? Stay warm, friend. We're here to help you plan for it.`;
                    } else {
                        greetingElement.innerHTML = "Hello and welcome! Pour a warm drink and get comfortable. You've come to the right place to find out if the snow will change your plans.";
                        // Set a cookie to remember the user for 1 year
                        document.cookie = `${COOKIE_NAME}=true; path=/; max-age=${365 * 24 * 60 * 60}; SameSite=Lax`;
                    }
                } catch (error) {
                    console.warn('Could not fetch location:', error);
                    // Fallback to the new user message if location fetch fails
                    greetingElement.innerHTML = "Hello and welcome! Pour a warm drink and get comfortable. You've come to the right place to find out if the snow will change your plans.";
                }
            }

            // 2. Flashing Loader Messages
            const loaderMessages = [
                "Analyzing weather patterns...",
                "Consulting the snow gods...",
                "Checking historical data...",
                "Calculating wind chill...",
                "Measuring snowflake density...",
                "Finalizing prediction..."
            ];
            const loaderMessageElement = document.getElementById('loaderMessage');
            let messageIndex = 0;
            let messageInterval;

            // Override the show loader logic to include flashing messages and delay
            const originalCalculate = window.calculateProbability;
            window.calculateProbability = async function(...args) {
                messageInterval = setInterval(() => {
                    loaderMessageElement.textContent = loaderMessages[messageIndex % loaderMessages.length];
                    messageIndex++;
                }, 1000);

                await originalCalculate.apply(this, args);
                clearInterval(messageInterval);
            };

            // 3. Ad Popup Logic
            function initializeAdPopup() {
                const popupOverlay = document.getElementById('adPopupOverlay');
                const closeButton = document.getElementById('closeAdPopup');
                const crossCloseButton = document.getElementById('crossClosePopup');

                // Show popup after 12 seconds
                setTimeout(() => {
                    popupOverlay.style.display = 'flex';
                }, 12000);

                // Close popup when "OK" is clicked
                closeButton.addEventListener('click', () => {
                    popupOverlay.style.display = 'none';
                });

                // Close popup when "X" is clicked
                crossCloseButton.addEventListener('click', () => {
                    popupOverlay.style.display = 'none';
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                fetchLocationAndGreet();
                initializeAdPopup();
            });

            // --- Online Users Counter Logic ---
            function updateOnlineUsers() {
                const counterElement = document.getElementById('online-users-count');
                if (!counterElement) return;

                fetch('/includes/online_users.php')
                    .then(response => response.json())
                    .then(data => {
                        // Only update if the count has changed
                        if (data.online_users !== undefined && counterElement.textContent !== data.online_users.toString()) {
                            // Fade out
                            counterElement.style.opacity = '0';

                            // Wait for fade out, then update text and fade in
                            setTimeout(() => {
                                counterElement.textContent = data.online_users;
                                counterElement.style.opacity = '1';
                            }, 300); // This should match the CSS transition duration
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching online users:', error);
                        counterElement.textContent = 'N/A';
                    });
            }

            // Update every 30 seconds
            setInterval(updateOnlineUsers, 30000);
            document.addEventListener('DOMContentLoaded', updateOnlineUsers);
        </script>

    </body>
</html>
