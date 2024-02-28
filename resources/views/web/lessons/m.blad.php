<a class="nav-link" id="nav-avatar-tab" data-toggle="pill" href="#nav-avatar" type="button" role="tab" aria-controls="nav-avatar" aria-selected="false"> إضافة صورة شخصية</a>

<div class="tab-pane fade text-right" id="nav-avatar" role="tabpanel" ari <section id="service" class="service">
    <div class="section-title2">
        <h2> إضافة صورة شخصية</h2>
    </div>
    <form class="sign" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <label for="name" class="mb-4"> إضافة صورة</label>
        <input type="file" name="image" accept="image/*" required style="background-color: transparent;height:auto">
        <button class="original-button" type="submit" name="addImage" value="addImage">إضافة</button>
    </form>
    </section>
</div>

if (isset($_POST['addImage'])) {
// Upload Variables
$formErrors = array();
$imgName = $_FILES['image']['name'];
$imgSize = $_FILES['image']['size'];
$imgTmp = $_FILES['image']['tmp_name'];
$imgType = $_FILES['image']['type'];
// List Of Allowed File Typed To Upload
$imgAllowedExtension = array("jpg", "png", "gif");
// Get Avatar Extension
$imgs = explode('.', $imgName);
$imgExtension = strtolower(end($imgs));
if (! empty($imgName) && ! in_array($imgExtension, $imgAllowedExtension)) {
$formErrors[] = 'امتداد الصورة هذا غير متوفر';
}
foreach($formErrors as $error) {
echo '<div class="alert pt-3 alert-danger alert-dismissible text-center fade show" role="alert" id="alert-message">
    ' . $error . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
// Check If There's No Error Proceed The Update Operation
if (empty($formErrors)) {
// Update The Database With This Info
$img = rand(0, 100000) . '_' . $imgName;
$uploads_dir = 'uploads';
move_uploaded_file($imgTmp, "$uploads_dir/$img");

$stmt = $con->prepare("UPDATE members SET avatar= ? WHERE userid = ?");
$stmt->execute(array($img, $_SESSION['uid'] ));
// Echo Success Message
echo '<div class="alert alert-success alert-dismissible text-center fade show" role="alert" id="alert-message">
    تم تعديل البيانات بنجاح
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
}