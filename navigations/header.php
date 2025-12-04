<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.2rem 2.5rem; /* Increased vertical and horizontal padding */
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
}
.header h1 {
    margin: 0;
    font-size: 1.6rem; /* Slightly larger for better presence */
}
.header h1 a {
    color: #fff; /* Ensure site name is white */
    text-decoration: none; /* Remove the underline */
}
.header nav {
    display: flex;
    gap: 2rem; /* Increased space between nav links */
}
.header nav a {
    color: #fff; /* White links for better contrast */
    text-decoration: none;
    font-size: 1.05rem;
    padding-bottom: 5px; /* Space for the underline effect */
    border-bottom: 2px solid transparent; /* Placeholder for hover effect */
    transition: border-color 0.3s ease, opacity 0.3s ease; /* Smooth transition */
}
.header nav a:hover {
    border-bottom-color: var(--accent); /* Use accent color for underline on hover */
    opacity: 0.9;
}
</style>
<header class="header">
    <h1>
        <a href="/">
            ❄️ SnowDay Calculator AI USA
        </a>
    </h1>
    <nav>
        <a href="/">Home</a>
        <a href="/blogs">Blogs</a>
        <a href="/about">About&nbsp;Us</a>
        <a href="/contact">Contact&nbsp;Us</a>
    </nav>
</header>