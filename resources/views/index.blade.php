@extends('templates.master')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">
                        Order Statistics
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12</div>
                            <div class="card-stats-item-label">Shipping</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Completed</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        59
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">
                        Product Statistics
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">Inventory</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12</div>
                            <div class="card-stats-item-label">On Sale</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Production</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Products</h4>
                    </div>
                    <div class="card-body">
                        36
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">
                        Customer Statistics
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">New</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12</div>
                            <div class="card-stats-item-label">Unverified</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Active</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Customers</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>Invoices</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><a href="#">INV-87239</a></td>
                            <td class="font-weight-600">Kusnadi</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#">INV-48574</a></td>
                            <td class="font-weight-600">Hasan Basri</td>
                            <td><div class="badge badge-success">Paid</div></td>
                            <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#">INV-76824</a></td>
                            <td class="font-weight-600">Muhamad Nuruzzaki</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#">INV-84990</a></td>
                            <td class="font-weight-600">Agung Ardiansyah</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#">INV-87320</a></td>
                            <td class="font-weight-600">Ardian Rahardiansyah</td>
                            <td><div class="badge badge-success">Paid</div></td>
                            <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4>Best Products</h4>
                </div>
                <div class="card-body">
                    <div class="owl-carousel owl-theme" id="products-carousel">
                        <div>
                            <div class="product-item pb-3">
                                <div class="product-image">
                                    <img alt="image" src="{{ asset('img/products/product-4-50.png') }}" class="img-fluid">
                                </div>
                                <div class="product-details">
                                    <div class="product-name">iBook Pro 2018</div>
                                    <div class="text-muted text-small">67 Sales</div>
                                    <div class="product-cta">
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="product-item">
                                <div class="product-image">
                                    <img alt="image" src="{{ asset('img/products/product-3-50.png') }}" class="img-fluid">
                                </div>
                                <div class="product-details">
                                    <div class="product-name">oPhone S9 Limited</div>
                                    <div class="text-muted text-small">86 Sales</div>
                                    <div class="product-cta">
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="product-item">
                                <div class="product-image">
                                    <img alt="image" src="{{ asset('img/products/product-1-50.png') }}" class="img-fluid">
                                </div>
                                <div class="product-details">
                                    <div class="product-name">Headphone Blitz</div>
                                    <div class="text-muted text-small">63 Sales</div>
                                    <div class="product-cta">
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection