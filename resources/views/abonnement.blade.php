@extends('layouts.ap')

@section('title','S\'abonner')

@section('content')
<div class="container py-5">
  <h2>S'abonner</h2>
  {{-- <form method="POST" action="{{ route('subscribe.pay') }}">
    @csrf
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Plan</label>
      <select name="plan" class="form-control">
        <option value="monthly">Mensuel - 5 000 XOF</option>
        <option value="yearly">Annuel - 50 000 XOF</option>
      </select>
    </div>
    <button class="btn btn-primary">Payer</button>
  </form> --}}
  <!-- resources/views/abonnement/form.blade.php -->
 <form action="{{ route('payment.create') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="name" class="form-label">Nom complet *</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" 
               id="email" name="email" value="{{ old('email', 'priscilialauress@gmail.com') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="phone" class="form-label">Téléphone *</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
               id="phone" name="phone" value="{{ old('phone', '0153999957') }}" required>
        <small class="text-muted">Format: 8 chiffres (ex: 97000000) ou avec indicatif (229...)</small>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="plan" class="form-label">Plan d'abonnement *</label>
        <select class="form-select @error('plan') is-invalid @enderror" id="plan" name="plan" required>
            <option value="" disabled {{ old('plan') ? '' : 'selected' }}>Sélectionnez un plan</option>
            <option value="monthly" {{ old('plan') == 'monthly' ? 'selected' : '' }}>
                Mensuel - 5,000 FCFA
            </option>
            <option value="yearly" {{ old('plan') == 'yearly' ? 'selected' : '' }}>
                Annuel - 50,000 FCFA
            </option>
        </select>
        @error('plan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
  
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="bi bi-credit-card"></i> Payer avec FedaPay
    </button>
</form>
</div>
@endsection
