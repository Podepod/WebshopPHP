<!DOCTYPE html>
<html lang="en">
<?php
    $page = "Klanten";
    include("./includes/htmlHead.php");
?>
<body>
    <?php
        include("./includes/navBar.php");
    ?>
    <div class="container p-4">
        <?php include("./includes/alert.php"); ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Registration Date</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < 7; $i++){ ?>
                    <tr <?php if($i == 4) echo('class="table-primary"') ?>> <!-- enkel als account admin rechten heeft: class="table-primary" --> 
                        <td><?php echo($i); ?></td>
                        <td>Lode Gilis</td> <!-- firstname + lastname -->
                        <td>lode@test.com</td> <!-- gwn email -->
                        <td>12/07/2002</td> <!-- DD/MM/YYYY -->
                        <td>01/11/2021 01:03</td> <!-- DD/MM/YYYY HH:mm -->
                        <td>
                            <?php if($i == 4){ ?>
                                <form action=""> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <button type="submit" class="btn btn-outline-info">Maak user</button>
                                </form>
                            <?php } else { ?>
                                <form action=""> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                    <button type="submit" class="btn btn-outline-success">Maak administrator</button>
                                </form>
                            <?php } ?>
                        </td> <!-- of verwijder admin als account al admin is -->
                        <td>
                            <form action=""> <!-- TODO ni vergete te checken of POST request van een admin komt (ni op deze pagina ma...) -->
                                <button type="submit" class="btn btn-outline-<?php if ($i == 4) echo('secondary'); else echo('danger'); ?>" <?php if ($i == 4) echo('disabled') ?>>Verwijder account</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>
</html>