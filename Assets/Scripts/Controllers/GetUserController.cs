using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class GetUserController : MonoBehaviour
{
    [SerializeField] private UserContainerModel userContainerModel;
    // Start is called before the first frame update
    void Start()
    {
    }
    public void SendRequest(string username, Action<UserContainerModel> OnCallback)
    {

        StartCoroutine(GetUser(username,OnCallback));
    }

    IEnumerator GetUser(string username, Action<UserContainerModel> OnCallback)
    {
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/progra241/e1/get_player.php",form))
        {
            yield return www.SendWebRequest();

            if(www.result==UnityWebRequest.Result.ConnectionError ||
                www.result == UnityWebRequest.Result.ProtocolError)
            {
                Debug.Log("Error");
            }
            else
            {
                userContainerModel = JsonUtility.FromJson<UserContainerModel>(www.downloadHandler.text);
                OnCallback(userContainerModel);
            }
        }
    }
}
