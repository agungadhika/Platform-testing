<?php
$xmlString = <<<EOT
<root>
    <data>example data</data>
</root>
EOT;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlString = $_POST['xmlString'];

    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Enable internal error handling

    try {
        // LIBXML_NOENT | LIBXML_DTDLOAD 
        $dom->loadXML($xmlString, LIBXML_NOENT | LIBXML_DTDLOAD);

        // Check for XML parsing errors
        $errors = libxml_get_errors();
        if (!empty($errors)) {
            $output = "XML parsing error: " . $errors[0]->message;
        } else {
            // Parse XML by XPATH
            $xpath = new DOMXPath($dom);
            $nodes = $xpath->query('/root/data');
            $output = $nodes->item(0)->nodeValue;
        }

        libxml_clear_errors(); // Clear the error buffer
    } catch (Exception $e) {
        $output = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>XXE Playground</title>
    <style>
        .output-textarea {
            white-space: normal !important;
            overflow-wrap: break-word !important;
            word-wrap: break-word !important;
        }

        html,
        body {
            height: 100%;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="#">
                    <p class="has-text-weight-bold">XXE Playground</p>
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
        </nav>
        <div class="content">
            <section class="section">
                <div class="container">
                    <div class="columns">
                        <div class="column is-half">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="field">
                                    <label class="label">XML Input:</label>
                                    <div class="control">
                                        <textarea class="textarea is-fullwidth" style="height: 50vh;" name="xmlString" placeholder="Enter XML here" required><?= htmlentities($xmlString); ?></textarea>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="column is-half">
                            <label class="label">Output:</label>
                            <?php if (isset($output)) : ?>
                                <div class="card" data-aos="fade-up">
                                    <div class="card-content">
                                        <div class="content">
                                            <textarea class="textarea is-static output-textarea" readonly><?php echo $output; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css">
    <script src="https://cdn.rawgit.com/jackmoore/autosize/v4.0.2/dist/autosize.min.js"></script>
    <!-- Your existing scripts go here -->

    <script>
        AOS.init();
        autosize(document.querySelectorAll('.output-textarea'));
    </script>
</body>

</html>