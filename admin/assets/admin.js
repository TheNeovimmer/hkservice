document.addEventListener('DOMContentLoaded', function () {
  var sidebar = document.getElementById('sidebar');
  var overlay = document.getElementById('sidebarOverlay');
  var toggle = document.getElementById('sidebarToggle');
  var collapseBtn = document.getElementById('sidebarCollapse');

  // Mobile sidebar toggle
  if (toggle && sidebar) {
    toggle.addEventListener('click', function () {
      sidebar.classList.toggle('show');
      if (overlay) overlay.classList.toggle('show');
    });
    if (overlay) {
      overlay.addEventListener('click', function () {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });
    }
  }

  // Desktop collapse/expand
  if (collapseBtn && sidebar) {
    var saved = localStorage.getItem('sidebarCollapsed');
    if (saved === 'true') sidebar.classList.add('collapsed');
    collapseBtn.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');
      localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    });
  }

  // Sub-menu toggle
  document.querySelectorAll('.nav-toggle').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      if (sidebar.classList.contains('collapsed')) return;
      var sub = this.nextElementSibling;
      var arrow = this.querySelector('.nav-arrow');
      if (sub) {
        sub.classList.toggle('open');
        if (arrow) arrow.classList.toggle('open');
      }
    });
  });

  // Auto-open sub-menu if a child is active
  document.querySelectorAll('.sub-menu').forEach(function (sub) {
    var active = sub.querySelector('.nav-link.active');
    if (active) {
      sub.classList.add('open');
      var parent = sub.closest('.nav-item');
      if (parent) {
        var arrow = parent.querySelector('.nav-toggle .nav-arrow');
        if (arrow) arrow.classList.add('open');
      }
    }
  });

  // Toast auto-dismiss
  document.querySelectorAll('.toast-auto').forEach(function (t) {
    setTimeout(function () { t.remove(); }, 5000);
  });
  document.querySelectorAll('.toast-close').forEach(function (btn) {
    btn.addEventListener('click', function () { this.closest('.toast').remove(); });
  });

  // Image upload preview
  document.querySelectorAll('.upload-input').forEach(function (input) {
    input.addEventListener('change', function () {
      var preview = this.closest('.upload-group').querySelector('.upload-preview');
      if (this.files && this.files[0] && preview) {
        var reader = new FileReader();
        reader.onload = function (e) { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(this.files[0]);
      }
    });
  });

  // Confirm delete
  document.querySelectorAll('.btn-confirm-delete').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) { e.preventDefault(); }
    });
  });
});

function addColorSwatch(containerId, inputId, hexId, nameId) {
  var container = document.getElementById(containerId);
  var hex = document.getElementById(hexId);
  var name = document.getElementById(nameId);
  var input = document.getElementById(inputId);
  if (!container || !input) return;
  var colors = [];
  try { colors = JSON.parse(input.value || '[]'); } catch(e) {}
  colors.push({ hex: hex ? hex.value : '#312783', name: name ? name.value : '' });
  input.value = JSON.stringify(colors);
  renderColorSwatches(containerId, inputId);
  if (hex) hex.value = '#312783';
  if (name) name.value = '';
}
function removeColorSwatch(containerId, inputId, index) {
  var container = document.getElementById(containerId);
  var input = document.getElementById(inputId);
  if (!container || !input) return;
  var colors = [];
  try { colors = JSON.parse(input.value || '[]'); } catch(e) {}
  colors.splice(index, 1);
  input.value = JSON.stringify(colors);
  renderColorSwatches(containerId, inputId);
}
function renderColorSwatches(containerId, inputId) {
  var container = document.getElementById(containerId);
  var input = document.getElementById(inputId);
  if (!container || !input) return;
  var colors = [];
  try { colors = JSON.parse(input.value || '[]'); } catch(e) {}
  container.innerHTML = colors.map(function(c, i) {
    return '<span class="color-swatch me-1 mb-1 badge bg-light border"><span class="dot" style="background:' + c.hex + '"></span> ' + (c.name || c.hex) + ' <button type="button" class="btn-close btn-close-sm ms-1" style="font-size:.6rem" onclick="removeColorSwatch(\'' + containerId + '\',\'' + inputId + '\',' + i + ')"></button></span>';
  }).join('');
}
