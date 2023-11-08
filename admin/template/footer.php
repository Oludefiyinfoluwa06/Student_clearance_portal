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

        // Sort by
        document.querySelector('#show-titles').addEventListener('click', () => {
            document.querySelector("#show-titles").style.display = 'none';
            document.querySelector("#hide-titles").style.display = 'block';
            document.querySelector(".table-titles").style.display = 'block';
        });

        document.querySelector('#hide-titles').addEventListener('click', () => {
            document.querySelector("#show-titles").style.display = 'block';
            document.querySelector("#hide-titles").style.display = 'none';
            document.querySelector(".table-titles").style.display = 'none';
        });
    </script>
</body>
</html>