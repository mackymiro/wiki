File: RemoteDesktop.ahk
#Include GlobalVariables.ahk
#Include functions.ahk
Loop % hosts.Length()
{
 

    Sleep, 2000
    Run, mstsc.exe
    Sleep, 2000
    ConnectToHost( hosts[A_Index].hostname )
    Sleep, 3000
    LoginToHost( hosts[A_Index] )
    Sleep, 6000
    TargetHostWindowTasks( hosts[A_Index] )

}
MsgBox All tasks are done
ExitApp
^c::
  MsgBox Exit App
  ExitApp

return