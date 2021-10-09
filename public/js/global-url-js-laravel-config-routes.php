index.blade.php

<script>
    // global app configuration object
    var config = {
        routes: {
            zone: "{{ URL::to('zone') }}"
        }
    };
</script>
<script src="main.js"></script>

2) main.js

$.ajax({
    type: "POST",
    cache: false,
    url : config.routes.zone,
    data: {'ma':$('select[name=ma]').val()},
    success: function(data) {
        ...
    }
});
