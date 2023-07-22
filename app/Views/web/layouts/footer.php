<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p><?= date('Y'); ?> &copy; Putri Laili Ramdhani</p>
            <script>
                $(document).ready(function() {
                    $('#showDataTable').DataTable();
                    $('.showDataTable').DataTable();
                    // Pilih kategori jika ada

                    // setTimeout(showTable, 2000)
                    console.log("DATATABLE DIPANGGIL")
                });

                function showTable() {
                    $('#showDataTable').DataTable();
                    $('.showDataTable').DataTable();
                    console.log("Load")
                }
            </script>

            <?php
            if (isset($data[0]->id_category)) {
            ?>
                <script>
                    console.log("INI JALAN");
                    let categoryValue = <?php echo $data[0]->id_category; ?>;
                    console.log(categoryValue);
                    $('#category option[value=' + categoryValue + ']').attr('selected', 'selected');
                </script>
            <?php
            }
            ?>
        </div>
    </div>
</footer>