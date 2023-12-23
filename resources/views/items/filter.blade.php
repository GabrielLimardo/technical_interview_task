<div class="filter">
        <h2>Filter:</h2>
        <form action="{{ url('/items') }}" method="get">
            <button type="submit" name="clearFilters" value="true">Clear Filters</button>
            <br>
            <i class="fas fa-plus-circle"></i>
            <br>
            <label for="perPage">Show:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()">
                <option value="5" {{ Request::input('perPage', 30) == 5 ? '' : 'selected' }}>5 products</option>
                <option value="10" {{ Request::input('perPage', 30) == 10 ? '' : 'selected' }}>10 products</option>
                <option value="15" {{ Request::input('perPage', 30) == 15 ? '' : 'selected' }}>15 products</option>
                <option value="30" {{ Request::input('perPage', 30) == 30 ? 'selected' : '' }}>30 products</option>
            </select>

            <div>
                <label for="orderBy">Sort by last modification:</label>
                <select name="orderBy" id="orderBy">
                    <option value="desc">Most recent to oldest</option>
                    <option value="asc">Oldest to most recent</option>
                </select>
            </div>

            <div>
                <select name="operator">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                </select>
            </div>

            <div>
                <label for="id">ID:</label>
                <select name="id_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="id" id="id" value="{{ request('id') }}">
            </div>

            <div>
                <label for="name">Name:</label>
                <select name="name_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="name" id="name" value="{{ request('name') }}">
            </div>

            <div>
                <label for="code">Code:</label>
                <select name="code_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="code" id="code" value="{{ request('code') }}">
            </div>

            <div>
                <label for="ean">EAN:</label>
                <select name="ean_filter">
                    <option value="contains">Contains</option>
                    <option value="does_not_contain">Does not contain</option>
                    <option value="is">Is equal to</option>
                    <option value="is_not">Is not equal to</option>
                </select>
                <input type="text" name="ean" id="ean" value="{{ request('ean') }}">
            </div>

            <div>
                <button type="submit">Filter</button>
            </div>
        </form>
</div>


@section('js')

    <script>
        $(document).ready(function(){
            $("h2").css('color', 'red');
          $("p").css({ 'color': 'blue', 'font-size': '18px' });
        });
    </script>

@endsection

