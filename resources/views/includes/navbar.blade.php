<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Combo Oferton</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
      </li>
      @if (Auth::user()->is_admin)
      <li class="nav-item">
        <a class="nav-link" href="{{url('promos')}}">Combos</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{url('sales')}}">Ventas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('customers')}}">Clientes</a>
      </li>
      @if (Auth::user()->is_admin)
      <li class="nav-item">
        <a class="nav-link" href="{{url('purchase_orders')}}">Órdenes de compra</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('providers')}}">Proveedores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('products')}}">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('families')}}">Familias</a>
      </li>
      @endif
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      <li class="nav-item dropdown">
          <table>
          <tr>
            <td>{{ Auth::user()->name }}</td>
            <td>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  ({{ __('Logout') }})
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </td>
          </tr>
          </table>
      </li>
    </ul>
    </div>
  </div>
</nav>
