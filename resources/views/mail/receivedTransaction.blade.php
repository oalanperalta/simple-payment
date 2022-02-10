<h3>Olá, {{ explode(" ", $name)[0] }}!!!</h1>


<p>Você recebeu uma transferência de {{ $payer }}.</p>

<p>
    Valor: R$ {{ number_format($value, 2, ',', '.') }} <br>
    Data: {{ \Carbon\Carbon::parse($date)->format('d/m/y H:i') }} <br>
</p>
