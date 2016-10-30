<!DOCTYPE html>
<html>
<head>
  <title>
    Developer's Best Friend : @yield('title')
  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <link rel="stylesheet" href="/css/p3.css"/>

</head>
<body>
  <div id="navbar">
    <a href="/">Home</a> ||
    <a href="/lorem">Lorem Ipsum Generator</a> ||
    <a href="/users">User Generator</a>
  </div>

    @if (count($errors) > 0)
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif


    <header>
      <h2>Developer's Best Friend</h2>
      <h3>@yield('title')</h3>
    </header>

    <section>
      @yield('content')
    </section>

    <footer>
      <div class="copy">
        &copy; David Lieberman, {{ date('Y') }}
      </div>
    </footer>
</body>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>

</html>
