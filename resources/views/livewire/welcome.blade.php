<div class="">
    <h1 class="text-grey-dark text-3xl font-bold mb-3">Files</h1>
    <div>
        <table id="filesTable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>
                Name
                </th>
                <th>
                Owner
                </th>
                <th>
                Last modified
                </th>
                <th>
                Download
                </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    let files = @js($files);
    let users = @js($users);
</script>
<script src="{{ asset('js/welcome.js') }}" defer></script>
