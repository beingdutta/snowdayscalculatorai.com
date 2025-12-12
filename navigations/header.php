<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2.5rem; /* Adjusted padding */
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
    position: relative; /* For mobile nav positioning */
}
.header .site-title {
    margin: 0;
    font-size: 1.4rem; /* Adjusted for responsiveness */
    font-weight: 700; /* Use a consistent bold font-weight */
    z-index: 10; /* Ensure title is above mobile nav */
}
.header .site-title a {
    color: #fff;
    text-decoration: none;
}
.header .main-nav { /* Changed from nav to .main-nav */
    display: flex;
    gap: 2rem;
}
.header .main-nav a {
    color: #fff;
    text-decoration: none;
    font-size: 1.05rem;
    padding-bottom: 5px;
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s ease, opacity 0.3s ease;
}
.header .main-nav a:hover {
    border-bottom-color: var(--accent);
    opacity: 0.9;
}

/* Hamburger Menu Button */
.hamburger-btn {
    display: none; /* Hidden on desktop */
    flex-direction: column;
    justify-content: space-around;
    width: 1.4rem; /* Further reduced size for better proportion */
    height: 1.4rem;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    z-index: 10;
}
.hamburger-btn span {
    width: 1.4rem; /* Match button width */
    height: 0.15rem; /* Make lines thinner */
    background: #fff;
    border-radius: 10px;
    transition: all 0.3s linear;
    position: relative;
    transform-origin: 1px;
}

/* Mobile Responsiveness */
@media (max-width: 820px) { /* Breakpoint when nav items get tight */
    .header {
        padding: 1rem 1.5rem;
        justify-content: center; /* Center the title */
    }
    .header .site-title {
        font-size: 1.2rem; /* Reduce title size on mobile */
    }
    .header .main-nav { /* Increased specificity */
        display: none; /* Hide nav on mobile */
        flex-direction: column;
        gap: 1rem;
        background: var(--primary);
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        padding: 1rem 0;
        z-index: 100; /* Ensure menu is on top of content */
        text-align: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .header .main-nav.active { /* Increased specificity */
        display: flex; /* Show mobile nav when active */
    }
    .hamburger-btn {
        display: flex; /* Show hamburger on mobile */
        position: absolute;
        top: 24%; /* Vertically center */
        right: 1.3rem;
        transform: translateY(-50%); /* Adjust for perfect centering */
    }
}

/* Online Users Counter */
.online-users { color: #fff; font-size: 0.9rem; margin-left: auto; padding-right: 2rem; }
@media (max-width: 820px) { .online-users { display: none; } }

/* Fade effect for online user count */
#online-users-count {
    transition: opacity 0.3s ease-in-out;
}
</style>
<header class="header">
    <?php
    $is_homepage = in_array($_SERVER['REQUEST_URI'], ['/', '/index.php']);
    $tag = $is_homepage ? 'h1' : 'div';
    ?>
    <<?php echo $tag; ?> class="site-title">
        <a href="/">
            SnowDay Calculator AI&nbsp;USA
        </a>
    </<?php echo $tag; ?>>
    <div class="online-users">
        <span id="online-users-count">...</span> users online
    </div>
    <nav class="main-nav" id="mainNav">
        <a href="/">Home</a>
        <a href="/blogs">Blogs</a>
        <a href="/about">About&nbsp;Us</a>
        <a href="/contact">Contact&nbsp;Us</a>
        <a href="/donate">Donate&nbsp;Us</a>
    </nav>
    <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mainNav = document.getElementById('mainNav');

        if (hamburgerBtn && mainNav) {
            hamburgerBtn.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                const isExpanded = mainNav.classList.contains('active');
                hamburgerBtn.setAttribute('aria-expanded', isExpanded);
            });
        }

        // --- Online Users Counter Logic ---
        function updateOnlineUsers() {
            const counterElement = document.getElementById('online-users-count');
            if (!counterElement) return;

            fetch('/includes/online_users.php')
                .then(response => response.json())
                .then(data => {
                    // Only update if the count has changed from the initial '...' or the previous value
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
        updateOnlineUsers(); // Initial call on DOM load
        setInterval(updateOnlineUsers, 30000); // And update every 30 seconds
    });
</script>