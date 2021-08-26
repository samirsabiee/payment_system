<?php


namespace App\Support\Basket;


use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;

class Basket
{
    private StorageInterface $storage;

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
        $this->storage->set($product->id, [
            'quantity' => $quantity
        ]);
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


}
