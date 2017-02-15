<nav aria-label="paination">
    <ul class="pagination">

        <?php if (isset($this->pagination)): ?>
            <?php if ($this->pagination['prime']): ?>

                <li>
                    <a href="<?php echo $link . $this->pagination['prime']; ?>"> First </a>
                </li>

            <?php else : ?>

                <li class="disabled">
                    <span>
                        First
                    </span>
                </li>

            <?php endif; ?>

            <?php if ($this->pagination['anterior']): ?>
                <li>
                    <a href="<?php echo $link . $this->pagination['anterior']; ?>"> Previous </a>
                </li>
            <?php else : ?>
                <li class="disabled">
                    <span>
                        Previous
                    </span>
                </li>
            <?php endif; ?>
<!--
            <?php /*for ($i = 0; $i < count($this->pagination['range']); $i++): */?>

                <?php /*if ($this->pagination['actual'] == $this->pagination['range'][$i]): */?>

                    <li class="active">
                        <a>
                            <?php /*echo $this->pagination['range'][$i]; */?>
                        </a>
                    </li>

                <?php /*else : */?>

                    <li>
                        <a href="<?php /*echo $link . $this->pagination['range'][$i]; */?>">
                            <?php /*echo $this->pagination['range'][$i]; */?>

                        </a>
                    </li>

                <?php /*endif; */?>

            --><?php /*endfor; */?>

            <?php if ($this->pagination['siguiente']): ?>

                <li>
                    <a href="<?php echo $link . $this->pagination['siguiente']; ?>"> Next </a>
                </li>

            <?php else : ?>

                <li class="disabled">
                    <span>
                        Next
                    </span>
                </li>

            <?php endif; ?>

            <?php if ($this->pagination['ultimo']): ?>

                <li>
                    <a href="<?php echo $link . $this->pagination['ultimo']; ?>"> Last </a>
                </li>

            <?php else : ?>

                <li class="disabled">
                    <span>
                        Last
                    </span>
                </li>

            <?php endif; ?>

        <?php endif; ?>

    </ul>
</nav>

