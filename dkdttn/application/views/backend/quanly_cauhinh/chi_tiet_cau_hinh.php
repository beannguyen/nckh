<?php if (!empty($info_cauhinh)): ?>
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <td>ID</td>
                <td><span class="badge"><?php echo $info_cauhinh->id ?></span></td>
            </tr>
            <tr>
                <td>Loại đề tài</td>
                <td><?php echo $info_cauhinh->tenloai ?></td>
            </tr>
            <tr>
                <td>Niên khóa</td>
                <td><?php echo $info_cauhinh->NamBD ?></td>
            </tr>
            <tr>
                <td>Học kỳ</td>
                <td><?php echo $info_cauhinh->hocky ?></td>
            </tr>
            <tr>
                <td>Năm học</td>
                <td><?php echo $info_cauhinh->namhoc ?></td>
            </tr>
            <tr>
                <td>SV tối đa</td>
                <td><span class="badge red"><?php echo $info_cauhinh->soluongSVtoida ?></span></td>
            </tr>
            <tr class="success">
                <td>thoigianSVbatdaudk</td>
                <td><?php echo date("H:i:s d-m-Y",strtotime($info_cauhinh->thoigianSVbatdaudk ))?></td>
            </tr>
            <tr class="danger">
                <td>thoigianSVketthucdk</td>
                <td><?php echo date("H:i:s d-m-Y",strtotime($info_cauhinh->thoigianSVketthucdk)) ?></td>
            </tr>
            <tr class="success">
                <td>thoigianGVbatdaudk</td>
                <td><?php echo date("H:i:s d-m-Y",strtotime($info_cauhinh->thoigianGVbatdaudk)) ?></td>
            </tr>
            <tr class="danger">
                <td>thoigianGVketthucdk</td>
                <td><?php echo date("H:i:s d-m-Y",strtotime($info_cauhinh->thoigianGVketthucdk)) ?></td>
            </tr>
            <tr>
                <td>Số lượng GVPB</td>
                <td><span class="badge red"><?php echo $info_cauhinh->soluongGVPBtoida ?></span></td>
            </tr>
            <tr>
                <td>Số lượng GVHD</td>
                <td><span class="badge green"><?php echo $info_cauhinh->soluongGVHDtoida ?></span></td>
            </tr>
            <tr>
                <td>Thời gian nộp báo cáo</td>
                <td><?php echo date("H:i:s d-m-Y",strtotime($info_cauhinh->thoigianSVktnopbc)) ?></td>
            </tr>
            <tr>
                <td>Điểm TB</td>
                <td><span class="badge red"><?php echo $info_cauhinh->diemTB ?></span></td>
            </tr>
            <tr>
                <td>Điểm Khá</td>
                <td><span class="badge red"><?php echo $info_cauhinh->diemKHA ?></span></td>
            </tr>
            <tr>
                <td>Điểm giỏi</td>
                <td><span class="badge red"><?php echo $info_cauhinh->diemGIOI ?></span></td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

<?php endif ?>
