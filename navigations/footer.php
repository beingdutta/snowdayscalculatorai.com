<style>
.footer {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    text-align: center;
    padding: 2rem 1rem;
    margin-top: 4rem; /* Increased top margin */
    box-shadow: 0 -4px 15px rgba(0, 0, 0, .1); /* Shadow on top */
}
.footer-nav {
    display: flex;
    justify-content: center;
    flex-wrap: wrap; /* Allow links to wrap on smaller screens */
    gap: 1rem 2rem; /* Row and column gap */
    margin-bottom: 1rem;
}
.footer-nav a {
    color: #fff;
    text-decoration: none;
    padding-bottom: 5px;
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s ease;
}
.footer-nav a:hover {
    border-bottom-color: var(--accent);
}
.footer-separator {
    border: 0;
    height: 1px;
    background-color: #fff;
    opacity: 0.2;
    margin: 1.5rem auto;
    width: 50%;
}
@media (max-width: 600px) {
    .footer-nav {
        gap: 0.5rem 1rem; /* Reduce gap on small screens */
        flex-direction: column; /* Stack links vertically */
    }
}
</style>
<footer class="footer">
    <nav class="footer-nav">
        <a href="/cookie_policy">Cookie Policy</a>
        <a href="/privacy">Privacy Policy</a>
        <a href="/terms">Terms & Conditions</a>
        <a href="/gdpr">GDPR</a>
    </nav>
    <hr class="footer-separator" />
    <p>&copy; 2025 Snowday AI Calculator. All rights reserved.</p>
</footer>