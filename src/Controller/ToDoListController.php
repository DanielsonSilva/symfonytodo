<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        $sortBy = ['id' => 'DESC'];
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy([], $sortBy);
        return $this->render('index.html.twig', ['tasks' => $tasks]);
    }
    
    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function createTask(Request $request)
    {
        if (is_null($request->request->get("title")) || empty($request->request->get("title"))) {
            return $this->redirectToRoute("to_do_list");
        }
        
        $em = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle($request->request->get("title"));
        $task->setStatus(false);
        $em->persist($task);
        $em->flush();
        
        return $this->redirectToRoute("to_do_list");
    }
    
    /**
     * @Route("/switch-status/{id}", name="switch_status")
     */
    public function switchStatus($id)
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $task->setStatus(!$task->getStatus());
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute("to_do_list");
    }
    
    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function deleteTask(Task $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        
        return $this->redirectToRoute("to_do_list");
    }
}
