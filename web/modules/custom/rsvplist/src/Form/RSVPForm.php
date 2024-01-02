<?php

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RSVPForm extends FormBase {
  public function getFormId() {
    return 'rsvplist_email_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getParameter('node');

    if ( !(is_null($node)) ) {
      $nid = $node->id();
    }
    else {
      $nid = 0;
    }

    $form['email'] = [
      '#type'  => 'textfield',
      '#title' => 'Email address',
      '#size' => 25,
      '#description' => 'We will send updates to the email address you provide',
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'RSVP',
    ];

    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

    $value = $form_state->getValue('email');

    if ( !(\Drupal::service('email.validator')->isValid($value)) ) {
      $form_state->setErrorByName('email',
        $this->t('It appear that %mail is not valid. Please try again', ['%mail' => $value]));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $submitted_email = $form_state->getValue('email');
    $this->messenger()->addMessage("The form is working! You entered {$submitted_email}");
  }
}
