@if (session()->has('toastSuccess'))
    <script>
        $(document).ready(function() {
            iziToast.success({
                title: 'Success',
                position: 'topRight',
                message: "{{ session('toastSuccess') }}",
            });
        })
    </script>
@elseif (session()->has('toastError'))
    <script>
        $(document).ready(function() {
            iziToast.error({
                title: 'Failed',
                position: 'topRight',
                message: "{{ session('toastError') }}",
            });
        })
    </script>
@elseif (session()->has('toastInfo'))
    <script>
        $(document).ready(function() {
            iziToast.info({
                title: 'Info',
                position: 'topRight',
                message: "{{ session('toastInfo') }}",
            });
        })
    </script>
@elseif (session()->has('toastWarning'))
    <script>
        $(document).ready(function() {
            iziToast.warning({
                title: 'Caution',
                position: 'topRight',
                message: "{{ session('toastWarning') }}",
            });
        })
    </script>
@endif
