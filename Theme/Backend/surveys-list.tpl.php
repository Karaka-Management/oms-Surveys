<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View               $this
 * @var \Modules\Surveys\Models\Survey[] $surveys
 */
$surveys = $this->data['surveys'] ?? [];

/** @var \Modules\Admin\Models\Account $account */
$account = $this->data['account'];

$accountDir = $account->id . ' ' . $account->login;

/** @var \Modules\Media\Models\Collection[] */
$collections = $this->data['collections'];
$mediaPath   = \urldecode($this->getData('path') ?? '/');

$previous = empty($surveys) ? '{/base}/survey/list' : '{/base}/survey/list?{?}&id=' . \reset($surveys)->id . '&ptype=p';
$next     = empty($surveys) ? '{/base}/survey/list' : '{/base}/survey/list?{?}&id=' . \end($surveys)->id . '&ptype=n';

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Surveys'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table id="surveyList" class="default sticky">
                <thead>
                <tr>
                    <td><label class="checkbox" for="surveyList-0">
                            <input type="checkbox" id="surveyList-0" name="surveyselect">
                            <span class="checkmark"></span>
                        </label>
                    <td>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                        <label for="surveyList-sort-1">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-1">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="surveyList-sort-2">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-2">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Tag'); ?>
                        <label for="surveyList-sort-3">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-3">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="surveyList-sort-4">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-4">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Creator'); ?>
                        <label for="surveyList-sort-5">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-5">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="surveyList-sort-6">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-6">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Created'); ?>
                        <label for="surveyList-sort-7">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-7">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="surveyList-sort-8">
                            <input type="radio" name="surveyList-sort" id="surveyList-sort-8">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                <tbody>
                <?php
                    $count = 0;
                    foreach ($surveys as $key => $value) : ++$count;
                        $url = UriFactory::build('{/base}/survey/edit?{?}&id=' . $value->id);
                    ?>
                    <tr data-href="<?= $url; ?>">
                        <td><label class="checkbox" for="surveyList-<?= $key; ?>">
                                <input type="checkbox" id="surveyList-<?= $key; ?>" name="surveyselect">
                                <span class="checkmark"></span>
                            </label>
                        <td>
                        <td><a href="<?= $url; ?>"><?= $value->getL11n()->title; ?></a>
                        <td>
                        <td><a class="content" href="<?= UriFactory::build('{/base}/profile/single?{?}&for=' . $value->createdBy->id); ?>"><?= $this->printHtml($this->renderUserName('%3$s %2$s %1$s', [$value->createdBy->name1, $value->createdBy->name2, $value->createdBy->name3, $value->createdBy->login ?? ''])); ?></a>
                        <td><a href="<?= $url; ?>"><?= $value->createdAt->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                    <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
            <div class="portlet-foot">
                <a tabindex="0" class="button" href="<?= UriFactory::build($previous); ?>"><?= $this->getHtml('Previous', '0', '0'); ?></a>
                <a tabindex="0" class="button" href="<?= UriFactory::build($next); ?>"><?= $this->getHtml('Next', '0', '0'); ?></a>
            </div>
        </div>
    </div>
</div>