<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'image', 'price'];

    public static function validate($request)
    {
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
    }

    public static function sumPricesByQuantities($products, $productsInSession)
    {
        $total = 0;
        foreach ($products as $product) {
            $total += $product->getPrice() * $productsInSession[$product->getId()];
        }
        return $total;
    }

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription()
    {
        return $this->getAttribute('description');
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getImage()
    {
        return $this->getAttribute('image');
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice()
    {
        return $this->getAttribute('price');
    }

    public function setPrice($price)
    {
        if ($price < 0) {
            throw new \Exception('Price cannot be negative.');
        }
        $this->attributes['price'] = $price;
    }

    public function getCreatedAt()
    {
        return $this->getAttribute('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute('updated_at');
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items()->saveMany($items);
    }
}

