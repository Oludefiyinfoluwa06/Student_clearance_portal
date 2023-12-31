    <script>
        // get date
        const date = document.getElementById("date");

        const currentDate = new Date();

        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        };
        date.innerText = new Intl.DateTimeFormat('en-US', options).format(currentDate);

        // menu
        const menuIcon = document.getElementById("menu");
        const closeIcon = document.getElementById("close");
        const nav = document.querySelector(".sections");

        menuIcon.addEventListener("click", () => {
            nav.style.top = "74px";
            menuIcon.style.display = "none";
            closeIcon.style.display = "block";
        });

        closeIcon.addEventListener("click", () => {
            nav.style.top = "-100%";
            closeIcon.style.display = "none";
            menuIcon.style.display = "block";
        });
    </script>
</body>
</html>