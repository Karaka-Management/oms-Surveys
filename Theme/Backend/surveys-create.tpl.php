<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Surveys\Models\SurveyElementType;

/** @var null|Modules\Surveys\Models\SurveyTemplate $survey */
$survey = $this->data['survey'];

echo $this->data['nav']->render(); ?>

<div class="tabview tab-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Survey'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Preview'); ?></label>
</ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= empty($this->request->uri->fragment) || $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <form>
                            <div class="portlet-head"><?= $this->getHtml('Survey'); ?></div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label for="iName"><?= $this->getHtml('Name'); ?></label>
                                    <input type="text" id="iName" name="name" value="<?= $this->printHtml($survey->l11n->title); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iStart"><?= $this->getHtml('Start'); ?></label>
                                    <input type="datetime-local" id="iStart" name="start" value="<?= $survey->start?->format('Y-m-d\TH:i'); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iEnd"><?= $this->getHtml('End'); ?></label>
                                    <input type="datetime-local" id="iEnd" name="end" value="<?= $survey->end?->format('Y-m-d\TH:i'); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iDesc"><?= $this->getHtml('Description'); ?></label>
                                    <textarea id="iDesc" name="desc"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="input-control">
                                        <label class="checkbox" for="iPublicResult">
                                            <input id="iPublicResult" type="checkbox" name="public_result" value="1"<?= isset($survey) && $survey->hasPublicResult ? ' checked' : ''; ?>>
                                            <span class="checkmark"></span>
                                            <?= $this->getHtml('ResultPublic'); ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iResponsibility"><?= $this->getHtml('Responsibility'); ?></label>
                                    <select id="iResponsibility" name="responsibility">
                                        <option value=""><?= $this->getHtml('Questionee'); ?>
                                        <option value=""><?= $this->getHtml('Manager'); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iPerm"><?= $this->getHtml('UserGroup'); ?></label>
                                    <span class="input"><button type="button" formaction=""><i class="g-icon">book</i></button><input type="text" id="iPerm" name="permission"></span>
                                </div>

                                <div class="form-group">
                                </div>
                            </div>
                            <div class="portlet-foot">
                                <input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="create-survey">
                            </div>
                        </form>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <form>
                            <div class="portlet-head"><?= $this->getHtml('Element'); ?></div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label for="iSection"><?= $this->getHtml('Section'); ?></label>
                                    <input type="text" id="iSection" name="section">
                                </div>

                                <div class="form-group">
                                    <label for="iSDesc"><?= $this->getHtml('Description'); ?></label>
                                    <textarea id="iSDesc" name="sdesc"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="iSType"><?= $this->getHtml('Type'); ?></label>
                                    <select id="iSType" name="stype">
                                        <option value="<?= SurveyElementType::HEADLINE; ?>"><?= $this->getHtml('Headline'); ?>
                                        <option value="<?= SurveyElementType::DROPDOWN; ?>"><?= $this->getHtml('Dropdown'); ?>
                                        <option value="<?= SurveyElementType::CHECKBOX; ?>"><?= $this->getHtml('Checkbox'); ?>
                                        <option value="<?= SurveyElementType::RADIO; ?>"><?= $this->getHtml('Radio'); ?>
                                        <option value="<?= SurveyElementType::TEXTFIELD; ?>"><?= $this->getHtml('Textfield'); ?>
                                        <option value="<?= SurveyElementType::TEXTAREA; ?>"><?= $this->getHtml('Textarea'); ?>
                                        <option value="<?= SurveyElementType::NUMERIC; ?>"><?= $this->getHtml('Numeric'); ?>
                                        <option value="<?= SurveyElementType::DATE; ?>"><?= $this->getHtml('Date'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="portlet-foot">
                                <input type="submit" value="<?= $this->getHtml('Add', '0', '0'); ?>" name="create-survey">
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-2' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <section class="portlet survey">
                        <form>
                            <div class="portlet-head"><?= $this->printHtml($survey->getL11n()->title); ?></div>
                            <div class="portlet-body">
                                <?php if (!empty($survey->getL11n()->description)) : ?>
                                    <article class="survey-description"><?= $survey->getL11n()->description; ?></article>
                                <?php endif; ?>
                                <?php
                                    foreach ($survey->elements as $element) {
                                        if ($element->type === SurveyElementType::HEADLINE) {
                                            echo '<h1>' . $this->printHtml($element->getL11n()->text) . '</h1>';

                                            echo empty($element->getL11n()->description)
                                                ? ''
                                                : '<h2>' . $element->getL11n()->description . '</h2>';
                                        } elseif ($element->type === SurveyElementType::CHECKBOX
                                            || $element->type === SurveyElementType::RADIO
                                            || $element->type === SurveyElementType::DROPDOWN
                                            || $element->type === SurveyElementType::TEXTFIELD
                                            || $element->type === SurveyElementType::TEXTAREA
                                            || $element->type === SurveyElementType::NUMERIC
                                            || $element->type === SurveyElementType::DATE
                                        ) {
                                            echo '<div class="survey-value-element">';

                                            // Question/Text section
                                            echo '<div class="question-section">';
                                            echo '<div class="question">' . $this->printHtml($element->getL11n()->text) . '</div>';
                                            echo empty($element->getL11n()->description)
                                                ? ''
                                                : '<article class="question-description">' . $element->getL11n()->description . '</article>';
                                            echo '</div>';

                                            // Value section
                                            echo '<div class="values-section">';
                                            if ($element->type === SurveyElementType::CHECKBOX
                                                || $element->type === SurveyElementType::RADIO
                                            ) :
                                                $elementLabels = $element->getLabels();
                                                if (($eCount = \count($elementLabels)) > 0) {
                                                    echo '<div class="labels">';
                                                }

                                                foreach ($elementLabels as $elementLabel) {
                                                    echo '<span class="label">' . $this->printHtml($elementLabel->title) . '</span>';
                                                }

                                                if ($eCount > 0) {
                                                    echo '</div>';
                                                }

                                                $elementValues = $element->getValues();
                                                echo '<div class="values">';
                                                foreach ($elementValues as $elementValue) :
                                                    if ($element->type === SurveyElementType::CHECKBOX) : ?>
                                                        <div class="input-control value">
                                                            <label class="checkbox" for="i<?= $element->id . '-' . $this->printHtml($elementValue); ?>">
                                                                <input id="i<?= $element->id . '-' . $this->printHtml($elementValue); ?>" type="checkbox" name="i<?= $element->id . '-' . $this->printHtml($elementValue); ?>" value="1">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    <?php elseif ($element->type === SurveyElementType::RADIO) : ?>
                                                        <div class="input-control value">
                                                            <label class="radio" for="i<?= $element->id . '-' . $this->printHtml($elementValue); ?>">
                                                                <input id="i<?= $element->id . '-' . $this->printHtml($elementValue); ?>" type="radio" name="i<?= $element->id; ?>" value="<?= $this->printHtml($elementValue); ?>"<?= isset($survey) && $survey->hasPublicResult ? '' : ''; ?>>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                <?php endif; endforeach;
                                                echo '</div>'; // closing "values"
                                             elseif ($element->type === SurveyElementType::DROPDOWN) :
                                                $elementValues = $element->getValues();

                                                echo '<select name="i' . $element->id . '>';
                                                $elementLabels = \array_values($element->getLabels());
                                                foreach ($elementValues as $key => $elementValue) : ?>
                                                    <option value="<?= $this->printHtml($elementValue); ?>"><?= $this->printHtml($elementLabels[$key]->title); ?>
                                            <?php endforeach;
                                            echo '</select>';
                                            elseif ($element->type === SurveyElementType::TEXTFIELD) : ?>
                                                <input type="text" name="i<?= $element->id; ?>">
                                            <?php elseif ($element->type === SurveyElementType::TEXTAREA) : ?>
                                                <textarea name="i<?= $element->id; ?>"></textarea>
                                            <?php elseif ($element->type === SurveyElementType::NUMERIC) : ?>
                                                <input type="number" name="i<?= $element->id; ?>">
                                            <?php elseif ($element->type === SurveyElementType::DATE) : ?>
                                                <input type="datetime-local" name="i<?= $element->id; ?>">
                                            <?php endif;
                                            echo '</div>'; // closing "values-section"
                                            echo '</div>'; // closing "survey-value-element"
                                        }
                                } ?>
                            </div>
                            <div class="portlet-foot">
                                <input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="create-survey">
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>