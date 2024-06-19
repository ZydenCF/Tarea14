using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using TMPro;

public class GetUserView : MonoBehaviour
{
    [SerializeField] private Button sendButton;
    [SerializeField] private TMP_InputField usernameInputField;
    [SerializeField] private TextMeshProUGUI resultText;
    private GetUserController controller;

    private void Awake()
    {
        controller = GetComponent<GetUserController>();
        sendButton.onClick.AddListener(SendRequest);
    }

    private void SendRequest()
    {
        string username = usernameInputField.text;
        controller.SendRequest(username,GetResult);
    }

    private void GetResult(UserContainerModel userContainerModel)
    {
        resultText.text = "";
        resultText.text += userContainerModel.user.user_id+"\n";
        resultText.text += userContainerModel.user.username + "\n";
        resultText.text += userContainerModel.user.score + "\n";
    }

}
