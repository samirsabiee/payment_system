<?php


namespace App\Support\Basket;


use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;

class Basket
{
    private StorageInterface $storage;
    public const TRANSPORT_COST = 10;

    /**
     * Basket constructor.
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws QuantityExceededException
     */
    public function add(Product $product, $quantity)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }
        $this->update($product, $quantity);
    }

    /**
     * @throws QuantityExceededException
     */
    public function update(Product $product, $quantity)
    {
        if (!$product->hasStock($quantity)) {
            throw new QuantityExceededException();
        }
        if (!(int)$quantity) {
            $this->storage->unset($product->id);
        } else {
            $this->storage->set($product->id, [
                'quantity' => $quantity
            ]);
        }
    }

    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

    public function has(Product $product)
    {
        return $this->storage->exist($product->id);
    }

    public function itemCount(): int
    {
        return $this->storage->count();
    }

    public function all()
    {
        $products = Product::find(array_keys($this->storage->all()));
        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
        }
        return $products;
    }

    public function subTotal()
    {
        $total = 0;
        foreach ($this->all() as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    public function clear()
    {
        $this->storage->clear();
    }


}
