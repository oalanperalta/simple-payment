<h3>Olá, {{ explode(" ", $name)[0] }}!!!</h1>


<p>Transferência no valor de R$ {{ number_format($value, 2, ',', '.') }} foi estornado.</p>

<p>
    Data: {{ \Carbon\Carbon::parse($date)->format('d/m/y H:i') }} <br>
</p>
