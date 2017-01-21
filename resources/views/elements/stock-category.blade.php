<div class="row">
    <div class="col-md-12">
        <div class="box with-border">
            <div class="box-header">
                <h3 class="box-title">
                    {{ $category->name }}
                </h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('label.product') }}</th>
                            <th>{{ trans('label.quantity') }}</th>
                            <th>{{ trans('label.ideal-quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <div class="form-group {{ $errors->first('products.'.$product->id.'.quantity') ? 'has-error' : '' }}">
                                        {{ Form::selectRange('products['.$product->id.'][quantity]', 0, config('krisslaure.stock-range-max'), $user->getProductPivot($product->id) ? $user->getProductPivot($product->id)->quantity : 0, ['class' => 'form-control']) }}
                                        {!! $errors->first('products.'.$product->id.'.quantity', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group {{ $errors->first('products.'.$product->id.'.optimal_quantity') ? 'has-error' : '' }}">
                                        {{ Form::selectRange('products['.$product->id.'][optimal_quantity]', 0, config('krisslaure.stock-range-max'), $user->getProductPivot($product->id) ? $user->getProductPivot($product->id)->optimal_quantity : 0, ['class' => 'form-control']) }}
                                        {!! $errors->first('products.'.$product->id.'.optimal_quantity', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
