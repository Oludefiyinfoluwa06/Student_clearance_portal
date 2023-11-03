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

        // animation on scroll
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                }
            });
        });

        const hiddenElements = document.querySelectorAll(".hidden");
        hiddenElements.forEach(el => observer.observe(el));

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

        // clearance form
        const semesterClearanceForm = document.querySelector(".semester-clearance");
        const examClearanceForm = document.querySelector(".exam-clearance");
        const scfTitle = document.querySelector(".scf");
        const ecfTitle = document.querySelector(".ecf");

        ecfTitle.addEventListener("click", () => {
            semesterClearanceForm.classList.add("hidden-form");
            examClearanceForm.classList.remove("hidden-form");
            scfTitle.classList.remove("active");
            ecfTitle.classList.add("active");
        });

        scfTitle.addEventListener("click", () => {
            semesterClearanceForm.classList.remove("hidden-form");
            examClearanceForm.classList.add("hidden-form");
            scfTitle.classList.add("active");
            ecfTitle.classList.remove("active");
        });

    </script>
</body>
</html>