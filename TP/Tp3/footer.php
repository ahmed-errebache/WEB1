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
  <script>
    // Show login modal if there's an error
    <?php if (!empty($login_error)): ?>
      document.getElementById('loginModal').style.display = 'block';
    <?php endif; ?>
    
    // Close modal when clicking outside
    window.onclick = function(event) {
      var modal = document.getElementById('loginModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>
</html>