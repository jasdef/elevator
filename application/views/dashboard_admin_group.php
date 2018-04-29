<div class="row-fluid">
    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">買賣單提醒</a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table sortable">
                <thead>
                <tr>
                    <th><a href="#">#</a></th>
                    <th><a href="#">表單名稱</a></th>
                    <th><a href="#">狀態</a></th>
                    <th><a href="#">開始日期</a></th>
                    <th><a href="#">總價</a></th>
                    <th><a href="#">剩餘款項</a></th>
                    <th class="sorttable_nosort">檢視</th>
                    <th class="sorttable_nosort">編輯</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($this->data) != 0) {

                    for ($j = 0; $j < count($this->data['transaction']); $j++) {
                        ?>
                        <tr>
                            <td><?= $this->data['transaction'][$j]->id; ?></td>
                            <td><?= $this->data['transaction'][$j]->name; ?></td>
                            <td><?= $this->data['transaction'][$j]->status; ?></td>
                            <td><?= $this->data['transaction'][$j]->start_date; ?></td>
                            <td><?= $this->data['transaction'][$j]->total_price; ?></td>
                            <td><?= $this->data['transaction'][$j]->left_money; ?></td>
                            <td>
                                <a href="<?= base_url("/Form/view_transaction_view") ?>/transaction_id/<?= $this->data['transaction'][$j]->id; ?>"><i
                                            class="icon-eye-open"></i></a>
                            </td>
                            <td>
                                <a href="<?= base_url("/Form/edit_transaction_view") ?>/transaction_id/<?= $this->data['transaction'][$j]->id; ?>"><i
                                            class="icon-pencil"></i></a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">簽約提醒 </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table sortable">
                <thead>
                <tr>
                    <th><a href="#">#</a></th>
                    <th><a href="#">表單類型</a></th>
                    <th><a href="#">表單名稱</a></th>
                    <th><a href="#">狀態</a></th>
                    <th class="sorttable_nosort">動作</th>
                    <th class="sorttable_nosort">取消</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($this->data) != 0) {

                    for ($j = 0; $j < count($this->data['remind_signing']); $j++) {
                        ?>
                        <tr>
                            <td><?= $this->data['remind_signing'][$j]->id; ?></td>
                            <td><?= $this->data['remind_signing'][$j]->type; ?></td>
                            <td><?= $this->data['remind_signing'][$j]->name; ?></td>
                            <td><?= $this->data['remind_signing'][$j]->status; ?></td>
                            <td>
                                <a href="<?= $this->data['remind_signing'][$j]->action; ?>"><?= $this->data['remind_signing'][$j]->action_name; ?></a>
                            </td>
                            <td>
                                <a href="<?= $this->data['remind_signing'][$j]->cancel; ?>"><i
                                            class="icon-remove"></i></a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>

<div class="row-fluid">
    <div class="block span6">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i
                            class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">本月保固保養名單</a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list">
                <thead>
                <tr>
                    <th><a href="#">#</a></th>
                    <th><a href="#">客戶名稱</a></th>
                    <th><a href="#">保固年限</a></th>
                    <th><a href="#">開始日期</a></th>
                    <th><a href="#">需做總數</a></th>
                    <th><a href="#">已做次數</a></th>
                    <th class="sorttable_nosort">檢視</th>
                    <th class="sorttable_nosort">編輯</th>
                    <th class="sorttable_nosort">派遣</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($this->data) != 0 && count($this->data['warranty']) != 0) {

                    for ($j = 0; $j < count($this->data['warranty']); $j++) {
                        ?>
                        <tr>
                            <td><?= $this->data['warranty'][$j]->id; ?></td>
                            <td><?= $this->data['warranty'][$j]->customer; ?></td>
                            <td><?= $this->data['warranty'][$j]->free_maintenance; ?></td>
                            <td><?= $this->data['warranty'][$j]->effective_date; ?></td>
                            <td><?= $this->data['warranty'][$j]->need_times; ?></td>
                            <td><?= $this->data['warranty'][$j]->warranty_times; ?></td>
                            <td>
                                <a href="<?= base_url("/Warranty/view_warranty_view") ?>/warranty_id/<?= $this->data['warranty'][$j]->id; ?>"><i
                                            class="icon-eye-open"></i></a>
                            </td>
                            <td>
                                <a href="<?= base_url("/Warranty/edit_warranty") ?>/warranty_id/<?= $this->data['warranty'][$j]->id; ?>"><i
                                            class="icon-pencil"></i></a>
                            </td>
							<td>
                                <a href="<?= base_url("/dispatch/addLog")?>/table_type/2/table_id/<?=$this->data['warranty'][$j]->id;?>"><i class="icon-group"></i></a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="block span6">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i
                            class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">本月保養合約保養名單</a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list">
                <thead>
                <tr>
                    <th><a href="#">#</a></th>
                    <th><a href="#">客戶名稱</a></th>
                    <th><a href="#">保養年限</a></th>
                    <th><a href="#">開始日期</a></th>
                    <th><a href="#">需做總數</a></th>
                    <th><a href="#">已做次數</a></th>
                    <th class="sorttable_nosort">檢視</th>
                    <th class="sorttable_nosort">編輯</th>
                    <th class="sorttable_nosort">派遣</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($this->data) != 0 && count($this->data['service']) != 0) {

                    for ($j = 0; $j < count($this->data['service']); $j++) {
                        ?>
                        <tr>
                            <td><?= $this->data['service'][$j]->id; ?></td>
                            <td><?= $this->data['service'][$j]->customer; ?></td>
                            <td><?= $this->data['service'][$j]->mechanical_warranty; ?></td>
                            <td><?= $this->data['service'][$j]->signing_day; ?></td>
                            <td><?= $this->data['service'][$j]->need_times; ?></td>
                            <td><?= $this->data['service'][$j]->service_times; ?></td>
                            <td>
                                <a href="<?= base_url("/service/view_service_view") ?>/service_id/<?= $this->data['service'][$j]->id; ?>"><i
                                            class="icon-eye-open"></i></a>
                            </td>
                            <td>
                                <a href="<?= base_url("/service/edit_service") ?>/service_id/<?= $this->data['service'][$j]->id; ?>"><i
                                            class="icon-pencil"></i></a>
                            </td>
							<td>
                                <a href="<?= base_url("/dispatch/addLog")?>/table_type/3/table_id/<?=$this->data['service'][$j]->id;?>"><i class="icon-group"></i></a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>