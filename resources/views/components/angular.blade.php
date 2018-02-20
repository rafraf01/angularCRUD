<script type="text/javascript" src="{{url('vendor/angular/angular.min.js')}}"></script>
<script type="text/javascript" src="{{ url('vendor/paginate/dirPagination.js') }}"></script>
<?php $angularModules = '';
if(isset($modules)): foreach($modules as $module => $path):
    $angularModules .= sprintf(',"%s"', $module);
    ?>
    <script type="text/javascript" src="{{url($path)}}"></script>
<?php endforeach;
    $angularModules = substr($angularModules, 1);
endif;
?>
<script type="text/javascript">
    var base_url = window.location.origin;
    var config = {
        "async": true,
        "crossDomain": true,
        "headers": {
            "cache-control": "no-cache",
            "Accept" : "application/json"
    }
    };
    var app = angular.module('TestApp', ['angularUtils.directives.dirPagination',<?php echo $angularModules; ?>], function($interpolateProvider){
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>') ;
    }).filter('dateFormat', function(){
        return function(x){
            return new Date(x);
        };
    }).directive('validate', function () {
        'use strict';
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function ($scope, $elem, attrs, ctrl) {

                var regReplace,
                    preset = {
                        'only-numbers': '0-9',
                        'numbers': '0-9\\s',
                        'only-letters': 'A-Za-z',
                        'letters': 'A-Za-z\\s',
                        'email': '\\wÑñ@._\\-',
                        'alpha-numeric': '\\w\\s'
                        //'latin-alpha-numeric': '\\w\\sÑñáéíóúüÁÉÍÓÚÜ´¨',
                        //'date-picker' : '^(?:(?:(?:0[1-9]|[12]\d|3[01])/(?:0[13578]|1[02])|(?:0[1-9]|[12]\d|30)/(?:0[469]|11)|(?:0[1-9]|1\d|2[0-8])/02)/(?!0000)\d{4}|(?:(?:0[1-9]|[12]\d)/02/(?:(?!0000)(?:[02468][048]|[13579][26])00|(?!..00)\d{2}(?:[02468][048]|[13579][26]))))$'
                    },
                    filter = preset[attrs.validate] || attrs.validate;

                $elem.on('input', function () {
                    regReplace = new RegExp('[^' + filter + ']', 'ig');
                    ctrl.$setViewValue($elem.val().replace(regReplace, ''));
                    ctrl.$render();
                });

            }
        };
    }).run(function($http){
        $http.defaults.async = true;
        $http.defaults.headers.common.Accept = "application/json";
        $http.defaults.headers.common["Cache-Control"] = "no-cache, max-age=0";
    });
</script>