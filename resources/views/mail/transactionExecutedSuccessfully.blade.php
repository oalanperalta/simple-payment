<h3>Olá, {{ explode(" ", $name)[0] }}!!!</h1>


<p>Em {{ \Carbon\Carbon::parse($date)->format('d/m/y H:i') }}, foi realizado um pagamento na sua carteira, no valor de R$ {{ number_format($value, 2, ',', '.') }}. Os dados de destino são:</p>

<p>
    Nome: {{ $payee}} <br>
    CPF/CNPJ:: {{ substr_replace(substr_replace($document, '*****', 2, 5), '*****', -7, 5) }} <br>
    Data: {{ \Carbon\Carbon::parse($date)->format('d/m/y H:i') }} <br>
</p>
