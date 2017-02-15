<nav aria-label="pagination" class="text-center">
    <ul class="pagination">


    <?php if (isset($this->pagination)): ?>
    <?php if ($this->pagination['prime']): ?>

        <li>
            <a class="page" page="<?php echo $this->pagination['prime']; ?>" href="javascript:void(0);">
                <<
            </a>
        </li>

    <?php else : ?>

        <li class="disabled">
            <span>
                <<
            </span>
        </li>

    <?php endif; ?>

    <?php if ($this->pagination['anterior']): ?>

        <li>
            <span>
                <a class="page" page="<?php echo $this->pagination['anterior']; ?>" href="javascript:void(0);">
                <
                </a>
            </span>
        </li>
    <?php else : ?>
        <li class="disabled">
            <span>
                <
            </span>
        </li>
    <?php endif; ?>


    <?php for ($i = 0; $i < count($this->pagination['range']); $i++): ?>

        <?php if ($this->pagination['actual'] == $this->pagination['range'][$i]): ?>

            <li class="active">
            <span>
                <?php echo $this->pagination['range'][$i]; ?>
            </span>
            </li>
        <?php else : ?>

            <li>
            <span>
                <a class="page" page="<?php echo $this->pagination['range'][$i]; ?>" href="javascript:void(0);">
                    <?php echo $this->pagination['range'][$i]; ?>

                </a>
            </span>
            </li>
        <?php endif; ?>

    <?php endfor; ?>

    <?php if ($this->pagination['siguiente']): ?>

        <li>
            <span>
            <a class="page" page="<?php echo $this->pagination['siguiente']; ?>" href="javascript:void(0);">
                >
            </a>
            </span>
        </li>
    <?php else : ?>

        <li class="disabled">
            <span>
            >
            </span>
        </li>

    <?php endif; ?>

    <?php if ($this->pagination['ultimo']): ?>

        <li>
            <span>
            <a class="page" page="<?php echo $this->pagination['ultimo']; ?>" href="javascript:void(0);">
                >>
            </a>
            </span>
        </li>
    <?php else : ?>

        <li class="disabled">
            <span>
            >>
            </span>
        </li>

    <?php endif; ?>

        <di class="text-center">
            <p>
                <small>
                    Page <?php echo $this->pagination['actual']; ?> of <?php echo $this->pagination['total']; ?>
                    <br/>
                    Show in this page: <select id="reg" class="span1">
                        <?php for($i = 0; $i <= 100; $i+=10):?>
                            <option value="<?php echo $i; ?>" <?php if($i==$this->pagination['limit']) {
                                echo'selected = "selected"';
                            }?> >
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </small>
            </p>
        </di>
<?php endif; ?>

    </ul>
</nav>
