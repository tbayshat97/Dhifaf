<template>
    <div class="row">
        <div class="col-md-12">
            <h3>{{translate('layout.my_orders')}}</h3>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-all-orders-tab" data-toggle="tab" data-target="#nav-all-orders" type="button" role="tab" aria-controls="nav-all-orders" aria-selected="true">{{translate('layout.all_orders')}}</button>
                    <button class="nav-link" id="nav-completed-tab" data-toggle="tab" data-target="#nav-completed" type="button" role="tab" aria-controls="nav-completed" aria-selected="false">{{translate('layout.completed')}}</button>
                    <button class="nav-link" id="nav-pending-tab" data-toggle="tab" data-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false">{{translate('layout.pending')}}</button>
                    <button class="nav-link" id="nav-canceled-tab" data-toggle="tab" data-target="#nav-canceled" type="button" role="tab" aria-controls="nav-canceled" aria-selected="false">{{translate('layout.canceled')}}</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active table-responsive" id="nav-all-orders" role="tabpanel" aria-labelledby="nav-all-orders-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{translate('layout.order_id')}}</th>
                                <th scope="col">{{translate('layout.address')}}</th>
                                <th scope="col">{{translate('layout.order_date')}}</th>
                                <th scope="col">{{translate('layout.price')}}</th>
                                <th scope="col">{{translate('layout.status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade table-responsive" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{translate('layout.order_id')}}</th>
                                <th scope="col">{{translate('layout.address')}}</th>
                                <th scope="col">{{translate('layout.order_date')}}</th>
                                <th scope="col">{{translate('layout.price')}}</th>
                                <th scope="col">{{translate('layout.status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade table-responsive" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{translate('layout.order_id')}}</th>
                                <th scope="col">{{translate('layout.address')}}</th>
                                <th scope="col">{{translate('layout.order_date')}}</th>
                                <th scope="col">{{translate('layout.price')}}</th>
                                <th scope="col">{{translate('layout.status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade table-responsive" id="nav-canceled" role="tabpanel" aria-labelledby="nav-canceled-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{translate('layout.order_id')}}</th>
                                <th scope="col">{{translate('layout.address')}}</th>
                                <th scope="col">{{translate('layout.order_date')}}</th>
                                <th scope="col">{{translate('layout.price')}}</th>
                                <th scope="col">{{translate('layout.status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="completed"><span>Completed</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="pending"><span>Pending</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                            <tr>
                                <td class="color">1</td>
                                <td>#78522135</td>
                                <td>351  Shearwood Forest Drive</td>
                                <td>20/03/2021</td>
                                <td>$376.00</td>
                                <td class="canceled"><span>Canceled</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>