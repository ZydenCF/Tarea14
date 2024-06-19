using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class RegisterController : MonoBehaviour
{
    public void SendRequest(string username, Action<RegisterModel> OnCallback)
    {
        StartCoroutine(Register(username, OnCallback));
    }

    IEnumerator Register(string username, Action<RegisterModel> OnCallback)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/progra241/e2/register_player.php", form))
        {
            yield return www.SendWebRequest();

            if (www.result == UnityWebRequest.Result.ConnectionError ||
                www.result == UnityWebRequest.Result.ProtocolError)
            {
                Debug.Log("Error");
            }
            else
            {
                
                OnCallback(JsonUtility.FromJson<RegisterModel>(www.downloadHandler.text));
            }
        }
    }
}
