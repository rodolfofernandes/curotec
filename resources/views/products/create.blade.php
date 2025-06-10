{{-- filepath: resources/views/products/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="mb-4">Product Registration</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form id="productForm" method="POST" action="{{ route('products.store') }}">
                        @csrf
                        {{-- Step 1 --}}
                        <div id="step-1" class="step">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <div class="invalid-feedback" id="error-name"></div>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" name="category_id" id="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="error-category_id"></div>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" name="color" id="color">
                                <div class="invalid-feedback" id="error-color"></div>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" min="0" class="form-control" name="stock" id="stock">
                                <div class="invalid-feedback" id="error-stock"></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" id="next-1">Next</button>
                            </div>
                        </div>
                        {{-- Step 2 --}}
                        <div id="step-2" class="step d-none">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" id="price">
                                <div class="invalid-feedback" id="error-price"></div>
                            </div>
                            <div class="mb-3">
                                <label for="has_discount" class="form-label">Has Discount?</label>
                                <select class="form-select" name="has_discount" id="has_discount">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                <div class="invalid-feedback" id="error-has_discount"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="back-2">Back</button>
                                <button type="button" class="btn btn-primary" id="next-2">Next</button>
                            </div>
                        </div>
                        {{-- Step 3 --}}
                        <div id="step-3" class="step d-none">
                            <div class="mb-3" id="discount-group">
                                <label for="discount_value" class="form-label">Discount Value</label>
                                <input type="number" step="0.01" class="form-control" name="discount_value" id="discount_value">
                                <div class="invalid-feedback" id="error-discount_value"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="back-3">Back</button>
                                <button type="submit" class="btn btn-success" id="submit-btn">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/product-form.js') }}"></script>
</body>
</html>