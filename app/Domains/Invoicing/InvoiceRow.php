<?php

namespace App\Domains\Invoicing;

class InvoiceRow
{
    public string $label = '';

    public int $quantity = 1;

    public int $price = 0;

    /**
     * @param  array{label: string, quantity: int, price: int}  $data
     */
    public function __construct(array $data)
    {
        $this->label = $data['label'];
        $this->quantity = $data['quantity'];
        $this->price = $data['price'];
    }

    public int $total {
        get {
            return $this->price * $this->quantity;
        }
    }
}
