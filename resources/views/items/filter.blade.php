<div class="filter">
        <h2>Filter:</h2>
        <form action="{{ url('/items') }}" method="get">
            <button type="submit" name="clearFilters" value="true">Clear Filters</button>
            <br>
            <br>
            <div>
                <label for="orderBy">Sort by:</label>
                <select name="orderBy" id="orderBy">
                    <option value="desc">Most recent to oldest</option>
                    <option value="asc">Oldest to most recent</option>
                </select>
            </div>
            <label for="perPage">Show:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()">
                <option value="5" {{ Request::input('perPage', 30) == 5 ? '' : 'selected' }}>5 products</option>
                <option value="10" {{ Request::input('perPage', 30) == 10 ? '' : 'selected' }}>10 products</option>
                <option value="15" {{ Request::input('perPage', 30) == 15 ? '' : 'selected' }}>15 products</option>
                <option value="30" {{ Request::input('perPage', 30) == 30 ? 'selected' : '' }}>30 products</option>
            </select>
            <br>
            <br>
            <div>
                <select name="operator">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                </select>
            </div>

            <div id="filterContainer">
                <div class="filterRow">
                    <select name="fields[]">
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="code">Code</option>
                        <option value="ean">EAN</option>
                    </select>
                    <select name="filterTypes[]">
                        <option value="contains">Contains</option>
                        <option value="does_not_contain">Does not contain</option>
                        <option value="is">Is</option>
                        <option value="is_not">Is not</option>
                    </select>
                    <input type="text" name="filterValues[]">
                </div>
            </div>

            <button onclick="addFilterRow()">+</button>

            <br>

            <div class="price-range-slider">
                <label for="amount">Rango de Precios:</label>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                <br>
                <input type="range" id="min-slider" min="0" max="999" value="0">
                <br>
                <input type="range" id="max-slider" min="0" max="999" value="999">
                <input type="hidden" name="filterPrice[price_range][min]" id="min_price">
                <input type="hidden" name="filterPrice[price_range][max]" id="max_price">
            </div>


            <br>

            <button type="submit">Filter</button>
        </form>
</div>




@section('js')

    <script>
          function addFilterRow() {
            const container = document.getElementById('filterContainer');
            event.preventDefault();

            const newRow = document.createElement('div');
            newRow.className = 'filterRow';

            const fieldDropdown = `
                <select name="fields[]">
                    <option value="name">Name</option>
                    <option value="id">ID</option>
                    <option value="code">Code</option>
                    <option value="ean">EAN</option>
                </select>
            `;

            const filterTypeDropdown = `
                <select name="filterTypes[]">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is</option>
                    <option value="is_not">Is not</option>
                </select>
            `;

            const valueInput = '<input type="text" name="filterValues[]">';

            const deleteButton = container.children.length === 0 ? '' : '<button onclick="removeFilterRow(this)">-</button>';

            newRow.innerHTML = `
                ${fieldDropdown}
                ${filterTypeDropdown}
                ${valueInput}
                ${deleteButton}
            `;

            container.appendChild(newRow);
        }

        function removeFilterRow(buttonElement) {
            const rowToRemove = buttonElement.parentElement;
            rowToRemove.remove();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const minSlider = document.getElementById('min-slider');
            const maxSlider = document.getElementById('max-slider');
            const minPrice = document.getElementById('min_price');
            const maxPrice = document.getElementById('max_price');
            const amount = document.getElementById('amount');

            // Configuración inicial
            updateValues();

            minSlider.addEventListener('input', updateValues);
            maxSlider.addEventListener('input', updateValues);

            function updateValues() {
                const minVal = minSlider.value;
                const maxVal = maxSlider.value;

                // Asegurarse de que el valor mínimo no sea mayor que el valor máximo
                if (parseInt(minVal) > parseInt(maxVal)) {
                    minSlider.value = maxVal;
                    minPrice.value = maxVal;
                }

                amount.value = "$" + minVal + " - $" + maxVal;
                minPrice.value = minVal;
                maxPrice.value = maxVal;
            }
        });


    </script>

@endsection

