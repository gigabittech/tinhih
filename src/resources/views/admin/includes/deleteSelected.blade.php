<script>
    function selectAll() {
        var selectAllCheckbox = document.getElementById('selectAll');
        var checkboxes = document.querySelectorAll('input[name="selectedIds[]"]');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });

        // Update the formIds input when using "Select All"
        updateFormIds();
    }

    function updateFormIds() {
        var selectedIds = [];
        var checkboxes = document.querySelectorAll('input[name="selectedIds[]"]:checked');

        checkboxes.forEach(function(checkbox) {
            selectedIds.push(checkbox.value);
        });

        var formIdsInput = document.getElementById('formIds');
        formIdsInput.value = selectedIds.join(',');

        var selectedForm = document.getElementById('selected-form');
        selectedForm.classList.toggle('d-none', selectedIds.length === 0);


        document.querySelector("#totalSelected").innerText = " (" + selectedIds.length + ")";
    }
</script>
