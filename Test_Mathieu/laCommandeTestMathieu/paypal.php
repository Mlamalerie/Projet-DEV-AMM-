<html>
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->

        <title>Page de paiement</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=Ae0hwalIu4jYQfJOup2Toy5iQHgLlK84Upq3nYmfD6y7UeQgyJDRrFOv-yI2IJZXUXhiXKhhPMhph1XV&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    layout: 'horizontal',
                    label: 'pay',

                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '2'
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction effectuée par ' + details.payer.name.given_name + '!');
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>
