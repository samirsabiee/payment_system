<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'code', 'amount'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function generateInvoice()
    {
        $pdf = Pdf::loadView('invoice', ['order' => $this]);
        return $pdf->save($this->invoicePath());
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function paid(): bool
    {
        return $this->payment->status;
    }

    public function downloadInvoice(): StreamedResponse
    {
        return Storage::disk('public')->download('invoices/' . $this->id . '.pdf');
    }

    public function invoicePath(): string
    {
        return storage_path('app/public/invoices/') . $this->id . '.pdf';
    }
}
