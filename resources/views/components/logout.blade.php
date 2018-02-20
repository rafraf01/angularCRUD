<a href="javascript:void(0);" onclick="this.nextElementSibling.submit()">logout</a>
<form method="post" action="{{ url('logout') }}">
    {{csrf_field()}}
</form>