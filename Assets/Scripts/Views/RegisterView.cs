using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using TMPro;
using UnityEngine.UI;

public class RegisterView : MonoBehaviour
{
    [SerializeField] private TMP_InputField usernameInputField;
    [SerializeField] private Button registerButton;
    [SerializeField] private TextMeshProUGUI messageText;
    private RegisterController controller;
    private void Awake()
    {
        registerButton.onClick.AddListener(ClickRegister);
        controller= GetComponent<RegisterController>();
    }

    private void ClickRegister()
    {
        controller.SendRequest(usernameInputField.text, OnResult);
    }

    private void OnResult(RegisterModel registerModel)
    {
        if (registerModel != null)
        {
            if (registerModel.data != null)
            {
                messageText.text = $"{registerModel.message}:\n{registerModel.data.user.username}";
            }
            else
            {
                messageText.text = $"{registerModel.message}";
            }
        }
        else
        {
            messageText.text = "Error desconocido";
        }
    }
}
