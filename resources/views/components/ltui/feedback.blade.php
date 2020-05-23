@if (session()->has('status'))
    @php
        $class = session('status')[0];
        $message = session('status')[1];
        switch ($class) {
            case 'success':
                $color = 'green';
                break;
            case 'error':
                $color = 'red';
                break;
            case 'info':
                $color = 'blue';
                break;
            default:
                $color = 'gray';
        }
    @endphp
    <div class="border rounded absolute right-0 mt-2 mr-2 bg-gray-100"
         style="width:300px; z-index:99"
         id="ltui-feedback">
        <div class="bg-{{ $color }}-400" style="height: 25px"></div>
        <div class="p-3">
            <p class="text-gray-700">{{ $message }}</p>
        </div>
    </div>

    <script>
        setTimeout(() => document.querySelector('#ltui-feedback').classList.add('hidden'), 7000);
    </script>
@endif
