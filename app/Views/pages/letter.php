<div class="container my-4">
  <h2 class="text-center mb-4">Searchable Table</h2>

  <!-- Search bar -->
  <div class="input-group mb-3">
    <input
      type="text"
      id="searchInput"
      class="form-control"
      placeholder="Search..."
      aria-label="Search"
      aria-describedby="search-button">
    <button class="btn btn-primary" type="button" id="search-button">
      Search
    </button>
  </div>

  <!-- Buttons for Check All / Uncheck All -->
  <div class="mb-3">
    <button class="btn btn-success" id="checkAllButton">Check All</button>
    <button class="btn btn-danger" id="uncheckAllButton">Uncheck All</button>
  </div>

  <!-- Table -->
  <table class="table table-bordered table-hover" style="text-align: center;">
    <thead class="table-dark">
      <tr>
        <th>Checklist</th> <!-- Header checkbox -->
        <th>ID</th>
        <th>Nomor</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Download</i></th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0001</td>
        <td>B-1768/18020/KP.320/2024</td>
        <td>Ahmad Faisal</td>
        <td>Surat Tugas</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0002</td>
        <td>B-1769/18020/KP.320/2024</td>
        <td>John Dalton</td>
        <td>Surat Cuti</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0003</td>
        <td>B-1770/18020/KP.320/2024</td>
        <td>John Doe</td>
        <td>Surat Cuti</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0004</td>
        <td>B-1768/18020/KP.320/2024</td>
        <td>Ahmad Faisal</td>
        <td>Surat Tugas</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0005</td>
        <td>B-1769/18020/KP.320/2024</td>
        <td>John Dalton</td>
        <td>Surat Cuti</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" class="rowCheckbox"></td>
        <td>0006</td>
        <td>B-1770/18020/KP.320/2024</td>
        <td>John Doe</td>
        <td>Surat Cuti</td>
        <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i< /a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- JavaScript -->
<script>
  // Search functionality
  document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      const match = Array.from(cells).some(cell =>
        cell.textContent.toLowerCase().includes(filter)
      );
      row.style.display = match ? '' : 'none';
    });
  });

  // Check All / Uncheck All for filtered rows
  const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
  const checkAllButton = document.getElementById('checkAllButton');
  const uncheckAllButton = document.getElementById('uncheckAllButton');

  // "Check All" button for visible rows
  checkAllButton.addEventListener('click', function() {
    const rows = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
      if (row.style.display !== 'none') { // Only check visible rows
        const checkbox = row.querySelector('.rowCheckbox');
        checkbox.checked = true;
      }
    });
  });

  // "Uncheck All" button for visible rows
  uncheckAllButton.addEventListener('click', function() {
    const rows = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
      if (row.style.display !== 'none') { // Only uncheck visible rows
        const checkbox = row.querySelector('.rowCheckbox');
        checkbox.checked = false;
      }
    });
  });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>