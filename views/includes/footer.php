    <script>
        var alert = document.querySelector(".alert")
        window.addEventListener('load', (event) => {
            setTimeout(function() {
                alert.style.opacity = '0';
            }, 2000);
            setTimeout(function() {
                alert.style.display = 'none';
            }, 2400);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>

    </html>