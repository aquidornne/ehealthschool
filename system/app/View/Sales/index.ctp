<div class="row border-bottom white-bg dashboard-header">
    <h2 class="noMarginTop">Vendas</h2>
    <?php //echo $this->element('breadcrumb'); ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Listagem</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="">Nome</th>
                                <th width="">Valor</th>
                                <th width="">Curso</th>
                                <th width="">Status</th>
                                <th width="">Data da Solicitação</th>
                                <th width="">Data do Pagamento</th>
                                <th width="">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $key => $row){ ?>
                                <tr>
                                    <td><?php echo $row['User']['name']; ?></td>
                                    <td><?php echo $this->Money2->convertReal($row['Sale']['mp_value'], 'R$ '); ?></td>
                                    <td><?php echo $row['Course']['name']; ?></td>
                                    <td>
                                        <?php if($row['Sale']['status'] == 'paid'){ ?>
                                            <span class="label label-success">Pago</span>
                                        <?php }else { ?>
                                            <span class="label label-warning">Pendente</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $this->Date->formatDate($row['Sale']['mp_created_at'], 'br'); ?></td>
                                    <td><?php echo $this->Date->formatDate($row['Sale']['mp_paid_at'], 'br'); ?></td>
                                    <td>
<!--                                        <a href="--><?php //echo $this->Html->url(array('action' => 'remove', $row['Sale']['id'], $row['Sale']['cover'])); ?><!--" class="btn btn-danger confirm"><i class="fa big fa-trash pull-right"></i></a>-->
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>

<script>
</script>