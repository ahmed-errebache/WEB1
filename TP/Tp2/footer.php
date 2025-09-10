<?php
// footer.php : code commun de fin de page
?>
  </div></main>
  <footer>
    <div class="container">
      <small>&copy; <?php echo htmlspecialchars($_SESSION['band_name']); ?> — Nous sommes le <?php echo date('d F Y'); ?>.</small>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>