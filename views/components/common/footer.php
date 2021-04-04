<style>
    .footer {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        background: var(--color-five);
    }

    .copyright {

        width: 100%;
        height: 50px;
        background: #191919;
        color: var(--color-three);
        display: flex;
        align-items: center;
        justify-content: center;
        /* border: 2px solid red; */

    }

    .copyright-content {
        /* border: 2px solid red; */
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        width: 100%;
        max-width: 600px;


    }

    .navigation {
        width: 100%;
        max-width: 1000px;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        height: 200px;

        padding: 3rem;
    }

    .footer .navigation .logo {
        color: var(--color-three);
        font-size: 3rem;
        font-weight: bolder;
    }

    .footer-navigation {
        flex: 1;
        padding: 2rem;
        font-size: 1.3rem;
        font-weight: 50;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        /* flex-direction: column; */
    }

    .footer-navigation a {
        color: var(--color-three);
        text-decoration: none;



    }
</style>
<footer class="footer">
    <div class="navigation">
        <div class="logo">
            StoryApp
        </div>
        <div class="footer-navigation">
            <a href="/">Home</a>
            <a href="/stories">Stories</a>
            <a href="/writers">Writers</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
        </div>
    </div>
    <div class="copyright">
        <div class="copyright-content">
            <span>COPYRIGHT &copy; 2021 - ALL RIGHTS RESERVED </span>|
            <span> StoryApp</span>
        </div>
    </div>
</footer>