<html>
<head>
    <script>
        setTimeout(function() {
            window.location.href = "{{ $url }}";
        }, 3000); // loader pendant 3 secondes
    </script>
</head>
<body>
    <div class="loader">🔄 Redirection en cours vers la plateforme Wave...</div>
</body>
</html>